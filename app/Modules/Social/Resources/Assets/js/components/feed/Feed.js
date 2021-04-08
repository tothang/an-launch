import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import PostForm from "./PostForm";
import Post from "./Post";
import Loader from "../Loader";
import Pagination from "../Pagination";

const Feed = () => {
    const [posts, setPosts] = useState([])
    const [page, setPage] = useState(0)

    useEffect(() => {
        axios.get('/api/feed')
        .then((response) => {
            setPosts(response.data);
        })
    }, [])

    useEffect(() => {
        Echo.channel('feed').listen(".FeedUpdated", (data) => {
            const newPost = data.post
            if (posts.find(post => post.id === newPost.id)) {
                if (newPost.comments) {
                    // New comment
                    setPosts(posts.map(post => (post.id === newPost.id ? {...post, comments: [...(post.comments || []), newPost.comments[0]]} : post)))
                } else {
                    // Liked post
                    setPosts(posts.map(post => (post.id === newPost.id ? {...post, ...newPost} : post)))
                }
            } else {
                // New post
                setPosts([{...newPost, comments: []}, ...posts])
            }
        })
        return () => Echo.leaveChannel('feed')
    }, [posts])

    if (!posts) {
        return <Loader />
    }

    return (
        <div>
            <div className="border border-light p-4 mt-2">
                <div className="row">
                    <div className="col-12">
                        <PostForm/>
                    </div>
                </div>
            </div>
            {posts.slice(page * 3, page * 3 + 3).map((post) => (
                <Post
                    key={post.id}
                    post={post}
                />
            ))}
            <div className="text-center">
                <Pagination page={page} setPage={setPage} pages={Math.ceil(posts.length/3)} />
            </div>
        </div>
    )
}

if (document.getElementById('react-social-feed')) {
    ReactDOM.render(<Feed/>, document.getElementById('react-social-feed'));
}

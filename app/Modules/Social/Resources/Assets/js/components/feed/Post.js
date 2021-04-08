import React, { useState } from 'react';
import axios from "axios";
import Like from "../Like";

const Post = ({post}) => {
    const [comment, setComment] = useState('')

    const handleInput = (e) => {
        setComment(e.target.value)
    }

    const sendComment = () => {
        axios.post(window.location.origin + '/api/comment/SocialPost/' + post.id, {
            body: comment,
        }).then(() => {
            setComment('')
        })
    }

    return (
        <div className={`border border-light p-4 mt-2 ${post.pinned ? 'pinned' : ''}`}>
            <i className={`fa fa-exclamation-circle d-inline ${post.pinned ? '' : 'hide'}`}></i>
            {
                post.image &&
                <div className="row">
                    <div className="col-12 text-center">
                        <img src={window.location.origin + '/storage/' + post.image} alt="Social post image" className="w-75 mb-4"/>
                    </div>
                </div>
            }
            <div className="row mb-2">
                <div className="col-md-8">
                    <h4>{post.body}</h4>
                    <Like likes={post.likes} Id={post.id} type="SocialPost"/>
                </div>
                <div className="col-md-4 text-right">
                    {
                        post.user !== null
                            ? <h4>{post.user}</h4>
                            : <h4>Admin</h4>
                    }
                    <p className="small">{post.posted}</p>
                </div>
            </div>
            <div className="row">
                <div className="col-12">
                    <div className="messages-wrapper">
                        {
                            post.comments.map((comment, index) => {
                                return <p key={index} className="text-dark p-2 mb-0 word-break-all border-dark">
                                    <span className="badge badge-pill badge-info">
                                        <b>{comment.user}</b>
                                    </span> - {comment.comment}
                                </p>
                            })
                        }
                    </div>
                </div>
                <div className="col-12 mt-4">
                    <div className="form-group">
                        <label htmlFor="body">Enter a comment:</label>
                        <textarea name="body" className="form-control" value={comment} onChange={handleInput} placeholder="Enter your message..." rows="3"></textarea>
                        <button className="btn btn-primary btn-sm mt-2 float-right" onClick={sendComment}>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Post

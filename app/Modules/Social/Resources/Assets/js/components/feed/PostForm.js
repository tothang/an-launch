import React, { useState } from 'react';
import axios from "axios";
import FileUpload from "../FileUpload";

const PostForm = () => {
    const [post, setPost] = useState('')
    const [file, setFile] = useState('')
    const [showConfirmation, setShowConfirmation] = useState(false)

    const created = () => {
        setShowConfirmation(true)
        setPost('')

        setTimeout(() => {
            setShowConfirmation(false)
        }, 3000)
    }

    const handleInput = (e) => {
        setPost(e.target.value)
    }

    const sendThread = () => {
        const url = window.location.origin + '/api/feed';
        const formData = new FormData();

        formData.append('image', file)
        formData.append('body', post)

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }
        axios.post(url, formData, config).then(created)
    }

    return (
        <div className="thread-form">
            <h4>Create a post</h4>

            {showConfirmation &&
                <div className="detail alert alert-info mb-2">
                    <h4 className="m-0">Post created!</h4>
                </div>
            }

            <div className="form-group">
                <FileUpload setFile={setFile} label="Image" />

                <label htmlFor="body">Post</label>
                <input type="text" name="body" className="form-control" value={post} onChange={handleInput} placeholder="Enter your post..."/>

                <button className="btn btn-primary btn-sm mt-2" onClick={sendThread}>Submit</button>
            </div>
        </div>
    )
}

export default PostForm

import React, { useState } from 'react';
import axios from "axios";
import Like from "../Like";

const Thread = ({thread}) => {
    const [comment, setComment] = useState('')

    const handleInput = (e) => {
        setComment(e.target.value)
    }

    const sendComment = () => {
        axios.post(window.location.origin + '/api/comment/ForumThread/' + thread.id, {
            body: comment,
        }).then((response) => {
            setComment('')
        })
    }

    return (
        <div className="border border-light p-4 mt-2">
            <div className="row mb-2">
                <div className="col-md-8">
                    <h4>{thread.body}</h4>
                    <Like likes={thread.likes} Id={thread.id} type="ForumThread"/>
                </div>
                <div className="col-md-4 text-right">
                    <h4>{thread.user}</h4>
                    <p className="small">{thread.posted}</p>
                </div>
            </div>
            <div className="row">
                <div className="col-12">
                    <div className="messages-wrapper">
                        {
                            thread.comments.map((comment, index) => {
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

export default Thread

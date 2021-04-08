import React, { useState } from 'react';
import axios from "axios";

const ThreadForm = ({topicId}) => {
    const [thread, setThread] = useState('')
    const [showConfirmation, setShowConfirmation] = useState(false)

    const created = () => {
        setShowConfirmation(true)
        setThread('')

        setTimeout(() => {
            setShowConfirmation(false)
        }, 3000)
    }

    const handleInput = (e) => {
        setThread(e.target.value)
    }

    const sendThread = () => {
        axios.post(window.location.origin + '/api/forum/' + topicId, {
            body: thread,
        }).then(created)
    }

    return (
        <div className="thread-form">
            <h4>Create a new thread</h4>

            {showConfirmation &&
                <div className="detail alert alert-info mb-2">
                    <h4 className="m-0">Thread created!</h4>
                </div>
            }

            <div className="form-group">
                <input type="text" name="body" className="form-control" value={thread} onChange={handleInput} placeholder="Enter your thread..."/>
                <button className="btn btn-primary btn-sm mt-2" onClick={sendThread}>Submit</button>
            </div>
        </div>
    )
}

export default ThreadForm

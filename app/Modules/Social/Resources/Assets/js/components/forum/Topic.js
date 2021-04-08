import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import Thread from "./Thread";
import ThreadForm from "./ThreadForm";
import Like from "../Like";
import Loader from "../Loader";
import Pagination from "../Pagination";

const Topic = ({topicId}) => {
    const [topic, setTopic] = useState(null)
    const [threads, setThreads] = useState([])
    const [page, setPage] = useState(0)

    useEffect(() => {
        axios.get('/api/forum/' + topicId)
        .then((response) => {
            setTopic(response.data);
            setThreads(response.data.threads);
        })
    }, [])

    useEffect(() => {
        Echo.channel('forum')
        .listen('.ForumTopicUpdated', (data) => {
            setTopic(data.topic);
        })
        .listen(".ForumThreadUpdated", (data) => {
            const newThread = data.thread
            if (threads && threads.find(thread => thread.id === newThread.id)) {
                if (newThread.comments) {
                    // New comment
                    setThreads(threads.map(thread => (thread.id === newThread.id ? {...thread, comments: [...(thread.comments || []), newThread.comments[0]]} : thread)))
                } else {
                    // Liked thread
                    setThreads(threads.map(thread => (thread.id === newThread.id ? {...thread, ...newThread} : thread)))
                }
            } else {
                // New thread
                setThreads([{...newThread, comments: []}, ...threads])
            }
        })
        return () => Echo.leaveChannel('forum')
    }, [threads, topic])

    if (!topic || !threads) {
        return <Loader />
    }

    return (
        <div>
            <div className="border border-light p-4">
                <div className="row">
                    <div className="col-md-6">
                        <h4>{ topic.title }</h4>
                        <Like likes={ topic.likes } type="ForumTopic" Id={topic.id} />
                    </div>
                    <div className="col-md-6 text-right">
                        <h4>
                            {threads.length} Threads
                            <br />
                            {topic.comment_count} Comments
                        </h4>
                    </div>
                </div>
            </div>

            <div className="border border-light p-4 mt-2">
                <div className="row">
                    <div className="col-12">
                        <ThreadForm topicId={topic.id}/>
                    </div>
                </div>
            </div>

            {threads.slice(page * 3, page * 3 + 3).map((thread) => (
                <Thread
                    key={thread.id}
                    thread={thread}
                />
            ))}

            <div className="text-center mt-4">
                <Pagination page={page} setPage={setPage} pages={Math.ceil(threads.length/3)} />
            </div>
        </div>
    )
}

if (document.getElementById('react-forum')) {
    const topicId = document.getElementById('react-forum').getAttribute('data-topic-id')

    ReactDOM.render(<Topic topicId={topicId}/>, document.getElementById('react-forum'));
}

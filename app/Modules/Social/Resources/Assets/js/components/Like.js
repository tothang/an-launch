import React, { useState, useEffect } from 'react';
import axios from "axios";

const Like = ({likes, Id, type}) => {
    const likedByUser = (likes) => !!likes.find(like => like === window.Laravel.userId)

    const [liked, setLiked] = useState(likedByUser(likes))

    useEffect(() => {
        setLiked(likedByUser(likes))
    }, [likes])

    const like = (type, Id) => {
        setLiked(!liked)
        axios.get(window.location.origin + '/api/like/' + type + '/' + Id)
    }

    return (
        <div>
            <i onClick={() => like(type, Id)} className={`fa fa-heart ${liked ? 'text-danger' : 'text-light'}`}></i> | {likes.length} Like{likes.length !== 1 && 's'}
        </div>
    )
}

export default Like

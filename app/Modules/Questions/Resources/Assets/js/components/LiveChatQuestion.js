import React, {Component} from 'react';

export default class LiveChatQuestion extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    const {question, handleToggleLike} = this.props

    return (
      <div
        className={`livechat-entry__container ${question.hasOwnProperty('liked') && question.liked ? ' liked' : ''}`}
        onClick={() => handleToggleLike(question)}
      >
        {question?.from ? question?.from : 'Admin'}
        <p>{question.question}</p>

        <div className="like__container">
          <span className='like__count'>{question.like_count}</span>
          <i id="like"
             className='fa fa-heart'/>
        </div>
      </div>
    )
  }
}

import React, {Component} from 'react';
import axios from "axios";

import LiveChatQuestion from "./LiveChatQuestion";

export default class LiveChat extends Component {
  constructor(props) {
    super(props);

    this.state = {
      questions: [],
    }

    this.handleToggleLike = this.handleToggleLike.bind(this);
  }

  componentDidMount() {
    const data = {
      'user_id': window.Laravel.userId,
    }

    axios.post('/api/questions', data).then(response => {
      this.setState({questions: response.data})
    });

    Echo.channel('questions')
      .listen('.UpdateLiveChat', (response) => {
        this.setState(prevState => ({questions: prevState.questions.concat(response.question)}));
      })
      .listen('.UpdateLikes', (response) => {
        let questions = [...this.state.questions];
        let questionIndex = questions.findIndex(element => element.id === response.question.id);

        questions[questionIndex].like_count = response.question.like_count
        this.sortLikes(questions)

        this.setState({questions: questions})
      })
      .listen('.QuestionModerated', (response) => {
        let questions = [...this.state.questions];
        let questionIndex = questions.findIndex(element => element.id === response.questionId);

        questions.splice(questionIndex, 1);

        this.setState({questions: questions})
      })
  }

  sortLikes(questions) {
    questions.sort(function (a, b) {
      if (a.like_count > b.like_count) {
        return -1;
      }
      if (a.like_count < b.like_count) {
        return 1;
      }
      return 0;
    })
  }

  handleToggleLike(question) {
    const data = {
      'user_id': window.Laravel.userId,
    }

    axios.post(`/api/questions/${question.id}/toggleLike`, data)
      .then(response => {
        let questions = [...this.state.questions];
        let questionIndex = questions.findIndex(element => element.id === question.id);

        questions[questionIndex].liked = response.data.liked;

        this.setState({questions: questions})
      })
  }

  render() {
    const {questions} = this.state
    const {handleToggleLike} = this

    return (
      <div className="fadeIn">
        <div className="livechat__wrapper">
          <div className="livechat__container">
            <div className="scrollable__content">
              {Object.keys(questions).map((question, key) => (
                <LiveChatQuestion
                  key={key}
                  question={questions[key]}
                  handleToggleLike={handleToggleLike}
                />
              ))}
              {questions.length === 0 && (
                <p className='scrollable__content__placeholder'>Be the first to ask a question!</p>
              )}
            </div>
          </div>
          <div className="livechat__fade">
            <div className="fade-overlay"></div>
          </div>
        </div>
      </div>
    )
  }
}

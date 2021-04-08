import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios'
import Response from "./Response";
import Question from "./Question";

export default class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            holdingMessage: '',
            questionId: '',
            question: '',
            answers: [],
            responses: [],
            multipleAnswers: false
        }
        this.setQuestion = this.setQuestion.bind(this);
        this.handleClick = this.handleClick.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.activeStatus = this.activeStatus.bind(this);
    }

    componentDidMount() {
        axios.post('/api/polls-and-quizzes', {
            'stream_id': this.props.streamId,
        }).then(response => {
            this.setQuestion(response.data)
        });
        Echo.channel('poll-quiz-question.' + this.props.streamId)
            .listen('.TriggerQuestion', (e) => {
                this.setQuestion(e)
            })
            .listen('.TriggerScore', () => {
                axios.post('/api/polls-and-quizzes-score', {
                    'user_id': window.Laravel.userId,
                }).then(response => {
                    this.setQuestion(response.data)
                });
            });
    }

    setQuestion(e) {
        this.setState({
            holdingMessage: e.holdingMessage ? e.holdingMessage: '',
            questionId: e.questionId ? e.questionId: '',
            question: e.question ? e.question: [],
            answers: e.answers ? e.answers: [],
            multipleAnswers: e.multipleAnswers ? e.multipleAnswers: false
        })
    }

    handleClick(answer) {
        this.setState(state => {
            let responses = [...state.responses, answer];

            if (this.state.multipleAnswers === false) {
                responses = [answer]
            }

            if (this.state.responses.includes(answer)) {
                responses = [...state.responses].filter((response) => {
                    return response !== answer
                })
            }

            return {
                responses,
                value: '',
            };
        });
    }

    activeStatus(answer) {
        if (this.state.responses.includes(answer)) {
            return 'btn-primary';
        }
    }

    handleSubmit() {
        const {questionId, responses} = this.state

        axios.post('/api/polls-and-quizzes/' + questionId, {
            'responses': responses,
        })
            .then(response => {
                this.setState({
                    responses: [],
                    holdingMessage: response.data.holding_message,
                });
            })
    }

    render() {
        const {holdingMessage, question, answers} = this.state
        const {handleClick, handleSubmit, activeStatus} = this

        return (
            <div className="question__container">
                {holdingMessage ?
                    <Response message={holdingMessage}/> :
                    <Question question={question} answers={answers} handleClick={handleClick}
                              handleSubmit={handleSubmit} activeStatus={activeStatus}/>
                }
            </div>
        );
    }
}

if (document.getElementById('poll-quiz-container')) {
    const element = document.getElementById('poll-quiz-container')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<App {...props}/>, element)
}

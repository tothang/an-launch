import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios'
import Holding from "./Holding";
import Form from "./Form";
import LiveChat from "./LiveChat";

export default class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      stream: '',
      from: '',
      to: '',
      question: '',
      speakers: [],
      success: false,
      isSubmitting: false,
    }

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleInput = this.handleInput.bind(this);
    this.handleSpeakerSelect = this.handleSpeakerSelect.bind(this);
    this.handleShowSuccess = this.handleShowSuccess.bind(this);
  }

  componentDidMount() {
    axios.get(`/api/questions/speakers`)
      .then((response) => {
        let speakers = response.data;
        speakers.map(function (speaker) {
          speaker.value = speaker.name;
          speaker.label = speaker.name;
        })

        this.setState({speakers: response.data});
    })

    this.setState({stream: document.getElementById('question-container').dataset.stream})
  }

  handleInput(e) {
    this.setState({[e.target.name]: e.target.value})
  }

  handleSpeakerSelect(e) {
    this.setState({to: e.value})
  }

  handleSubmit() {
    const {stream, from, to, question} = this.state
    const data = {
      'api_token': window.Laravel.apiToken,
      'stream_id': stream,
      'from': from,
      'to': to,
      'question': question,
    }

    this.setState({isSubmitting: true});

    axios.post(`/api/questions/store`, data)
      .then(() => {
        this.setState({
          to: '',
          question: '',
        });
      }).finally(() => {
      this.handleShowSuccess();
    });
  }

  handleShowSuccess() {
    this.setState({success: true})

    setTimeout(() => {
      this.setState({
        success: false,
        isSubmitting: false
      })
    }, 2000);
  }

  render() {
    const {from, question, speakers, isSubmitting, success} = this.state
    const {handleSubmit, handleInput, handleSpeakerSelect} = this

    return (
      <div className="question__container">
        {/* <LiveChat/> */}

        <div class="question-content">What color is an Orange?</div>

        <div class="form-group">
          <textarea class="form-control" rows="10" placeholder="Text for options to be added here"></textarea>
        </div>

        {/* {isSubmitting &&
        <Holding
          message={success ? 'Thank you for your submission.' : 'Submitting'}
        />
        }

        {isSubmitting === false &&
        <Form
          from={from}
          question={question}
          speakers={speakers}
          handleInput={handleInput}
          handleSpeakerSelect={handleSpeakerSelect}
          handleSubmit={handleSubmit}
        />
        } */}
      </div>
    );
  }
}

if (document.getElementById('question-container')) {
  ReactDOM.render(<App/>, document.getElementById('question-container'));
}

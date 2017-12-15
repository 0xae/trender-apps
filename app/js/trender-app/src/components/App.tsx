import * as React from 'react';
import '../App.css';
import Welcome from './Welcome';
import Clock from './Clock';

const logo = require('../logo.svg');

class App extends React.Component {
  render() {
    return (
        <div className="App">
            <div className="App-header">
                <img src={logo} className="App-logo" alt="logo" />
                <div id="clock" />
                <h2>Welcome to React</h2>
                <Clock />
            </div>

            <div className="App-intro">
                Welcome to trender app
            </div>

            <Welcome name="Stranger" />
        </div>
    );
  }
}

export default App;

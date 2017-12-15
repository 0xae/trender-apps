import * as React from 'react';
import * as ReactDOM from 'react-dom';
import App from './components/App';
import tick from './components/Clock';

import registerServiceWorker from './registerServiceWorker';
import './index.css';

ReactDOM.render(
  <App />,
  document.getElementById('root')
);

setInterval(tick, 1000);
registerServiceWorker();

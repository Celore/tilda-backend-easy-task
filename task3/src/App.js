import logo from './logo.svg';
import './App.css';
import Phone from './components/phone';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <Phone />
        <img src={logo} className="App-logo" alt="logo" />
      </header>
    </div>
  );
}

export default App;

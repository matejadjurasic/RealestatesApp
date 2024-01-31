import React from 'react';
import './footer.css';

const Footer = () => {
    return (
      <footer className="footer">
        <p></p>
        <div>
          <a href="#" className="footerLink">
            Link 1
          </a>
          <a href="#" className="footerLink">
            Link 2
          </a>
          {/* Add more links as needed */}
        </div>
      </footer>
    );
  };
  
  export default Footer;
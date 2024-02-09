// App.js
import React from 'react';
import RealEstate from './RealEstates/realEstate';
import RealEstates from './RealEstates/realEstates';
import Navbar from './Navbar/navbar';
import Login from './Login/login';
import { useAuth } from './Auth/authContext';
import { BrowserRouter as Router, Route, Routes, Navigate } from 'react-router-dom';
import { AuthProvider } from './Auth/authContext';
import Logout from './Logout/logout';
import Register from './Register/register';
import Footer from './Footer/footer';
import SearchBar from './SearchBar/searchbar';
import SearchTable from './SearchBar/SearchResult';
import SearchResult from './SearchBar/SearchResult';

function App() {
  const { authenticated, role } = useAuth();

  return (
    <Router>
      <AuthProvider>
        <Routes>
          {/* Add more routes as needed */}
          <Route path="*" element={!authenticated ? <Navigate to="/" /> : null} />
          <Route
            path="/"
            element={[<Navbar />, <SearchBar />, <RealEstates />, <Footer />]}
          />
           <Route
            path="/search"
            element={[<Navbar />, <SearchBar />, <SearchResult/>,<Footer />]}
          />
          <Route
            path="/login"
            element={!authenticated ? [<Navbar />, <Login />,<Footer />] : <Navigate to="/" />}
          />
          <Route
            path="/register"
            element={!authenticated ? [<Navbar />, <Register />,<Footer />] : <Navigate to="/" />}
          />

          {authenticated && (
            <>
              <Route path="/" element={[<Navbar />, <RealEstates />,<Footer />]} />
              <Route path="/logout" element={<Logout />} />
            </>
          )}
        </Routes>
        
      </AuthProvider>
    </Router>
  );
}

export default App;

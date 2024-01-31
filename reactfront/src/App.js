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
import SearchTable from './SearchBar/SearchTable';

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
            element={[<Navbar />, <SearchBar />, <RealEstates />]}
          />
           <Route
            path="/search"
            element={[<Navbar />, <SearchBar />, <SearchTable />]}
          />
          <Route
            path="/login"
            element={!authenticated ? [<Navbar />, <Login />] : <Navigate to="/" />}
          />
          <Route
            path="/register"
            element={!authenticated ? [<Navbar />, <Register />] : <Navigate to="/" />}
          />

          {authenticated && (
            <>
              <Route path="/" element={[<Navbar />, <RealEstates />]} />
              <Route path="/logout" element={<Logout />} />
            </>
          )}
        </Routes>
        <Footer />
      </AuthProvider>
    </Router>
  );
}

export default App;

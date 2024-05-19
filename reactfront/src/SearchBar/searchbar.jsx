import React, { useState, useEffect } from 'react';
import { search } from '../Api/api';
import {  BrowserRouter as Router, Route, Link, useNavigate} from 'react-router-dom';
import './searchbar.css';

const SearchBar = ({ onSearch }) => {
  const [searchTerm, setSearchTerm] = useState('');
  const [locations, setLocations] = useState([]);
  const [selectedLocation, setSelectedLocation] = useState('');
  const [selectedOperator, setSelectedOperator] = useState('');
  const [priceStart, setPriceStart] = useState('');
  const [priceEnd, setPriceEnd] = useState('');
  const [operators, setOperators] = useState(['=', '<', '>', 'between']);
  const navigate = useNavigate();

  useEffect(() => {
    search('','','','','').then((data) => {
      const allLocations = data['locations'];
      setLocations(allLocations);
    });
  }, []);


  //preusmeravanje na search url
  const handleSearch = async () => {
    try {
      const searchParams = new URLSearchParams( {
        q: searchTerm,
        location_name: selectedLocation,
        operator: selectedOperator,
        price_start: priceStart,
        price_end: priceEnd,
      }).toString();

      window.location.href = `/search?${searchParams}`;
    } catch (error) {
      console.error('Error during search:', error);
    }
  };

  return (
    <div className='search-container'>
      <input
        type="text"
        placeholder="Search by username..."
        value={searchTerm}
        onChange={(e) => setSearchTerm(e.target.value)}
      />

      <select value={selectedLocation} onChange={(e) => setSelectedLocation(e.target.value)}>
        <option value="">All locations</option>
        {locations.map((location, index) => (
          <option key={index} value={location}>
            {location}
          </option>
        ))}
      </select>

      <select value={selectedOperator} onChange={(e) => setSelectedOperator(e.target.value)}>
        <option value="">Select operator</option>
        {operators.map((operator) => (
          <option key={operator} value={operator}>
            {operator}
          </option>
        ))}
      </select>

      <input
        type="text"
        placeholder="Price start"
        value={priceStart}
        onChange={(e) => setPriceStart(e.target.value)}
      />

      <input
        type="text"
        placeholder="Price end"
        value={priceEnd}
        onChange={(e) => setPriceEnd(e.target.value)}
      />

      <button onClick={handleSearch}>Search</button>
    </div>
  );
};

export default SearchBar;

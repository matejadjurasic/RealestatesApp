import React, { useState, useEffect } from 'react';
import { fetchRealEstates } from '../Api/api';

const SearchBar = ({ onSearch }) => {
  const [searchTerm, setSearchTerm] = useState('');
  const [locations, setLocations] = useState([]);
  const [selectedLocation, setSelectedLocation] = useState('');
  const [selectedOperator, setSelectedOperator] = useState('');
  const [priceStart, setPriceStart] = useState('');
  const [priceEnd, setPriceEnd] = useState('');
  const [operators, setOperators] = useState(['=', '<', '>', 'izmedju']);

  useEffect(() => {
    fetchRealEstates().then((data) => {
      const estateData = (data && data.estate) ? data.estate : [];
      const allLocations = estateData.map((estate) => estate.location);
      const uniqueLocations = [...new Set(allLocations)];
      setLocations(uniqueLocations);
    });
  }, []);

  const handleSearch = async () => {
    try {
      const searchParams = {
        q: searchTerm,
        location_name: selectedLocation,
        operator: selectedOperator,
        price_start: priceStart,
        price_end: priceEnd,
      };

      const searchResults = await fetchRealEstates(searchParams);
      onSearch(searchResults);
    } catch (error) {
      console.error('Error during search:', error);
    }
  };

  return (
    <div>
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


import React, { useEffect, useState } from 'react';
import { fetchRealEstates } from '../Api/api';
import RealEstate from './realEstate';
import './realEstates.css';

const RealEstates = () => {
  const [realEstates, setRealEstates] = useState([]);



  useEffect(() => {
    fetchRealEstates().then((data) => { setRealEstates(data); console.log(data.estate) });
  }, []);

  return (
    <div>
      <h1>Real Estates</h1>
      <div className="real-estate-grid">
      {realEstates?.map((estate) => (
        <div className="real-estate-item" key={estate.id}>
        <RealEstate key={estate.id} realEstate={estate} />
        </div>
      ))}
      </div>
    </div>
  );
};

export default RealEstates;

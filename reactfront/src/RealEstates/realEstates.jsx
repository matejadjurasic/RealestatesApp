
import React, { useEffect, useState } from 'react';
import { fetchRealEstates } from '../Api/api';
import RealEstate from './realEstate';

const RealEstates = () => {
  const [realEstates, setRealEstates] = useState([]);



  useEffect(() => {
    fetchRealEstates().then((data) => { setRealEstates(data); console.log(data.estate) });
  }, []);

  return (
    <div>
      <h1>Real Estates</h1>
      {realEstates?.map((estate) => (
        <RealEstate key={estate.id} realEstate={estate} />
      ))}
    </div>
  );
};

export default RealEstates;

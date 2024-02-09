import React,{useState,useEffect} from 'react';
import RealEstate from '../RealEstates/realEstate';
import { useLocation } from 'react-router-dom';
import { search } from '../Api/api';

const SearchResult = () => {

  const[searchResult,setSearchResult]=useState([]);
  
  const location = useLocation();
  const queryParams = new URLSearchParams(location.search);

  const searchTerm = queryParams.get('q');
  const selectedLocation = queryParams.get('location_name');
  const selectedOperator = queryParams.get('operator');
  const priceStart = queryParams.get('price_start');
  const priceEnd = queryParams.get('price_end');

  useEffect(() => {
    search(searchTerm, selectedLocation, selectedOperator, priceStart, priceEnd).then((data) => {
      setSearchResult(data['realestates_details']);
    });
  }, [searchTerm, selectedLocation, selectedOperator, priceStart, priceEnd]);

  

  return (
    <div>
      <h1>Real Estates</h1>
      <div className="real-estate-grid">
      {searchResult?.map((estate) => (
        <div className="real-estate-item" key={estate.id}>
        <RealEstate key={estate.id} realEstate={estate} />
        </div>
      ))}
      </div>
    </div>
  );
};

export default SearchResult;
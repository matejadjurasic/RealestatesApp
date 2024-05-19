import React, { useEffect, useState } from 'react';
import { fetchRealEstates } from '../Api/api';
import RealEstate from './realEstate';
import './realEstates.css';

const RealEstates = () => {
  const [realEstates, setRealEstates] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);

  //fetches data and number of pages
  useEffect(() => {
    fetchRealEstates(currentPage).then((data) => { 
      setRealEstates(data['data']);
      setTotalPages(data['last_page']);
     });
  }, [currentPage]);

  const handlePreviousPage = () => {
    if (currentPage > 1) {
      setCurrentPage(currentPage - 1);
    }
  };

  const handleNextPage = () => {
    if (currentPage < totalPages) {
      setCurrentPage(currentPage + 1);
    }
  };

  const handlePageClick = (pageNumber) => {
    setCurrentPage(pageNumber);
  };

  return (
    <div>
      
      <div className="real-estate-grid">
      {realEstates?.map((estate) => (
        <div className="real-estate-item" key={estate.id}>
        <RealEstate key={estate.id} realEstate={estate} />
        </div>
      ))}
      </div>
      <div className="pagination">
        <button onClick={handlePreviousPage} disabled={currentPage === 1}>Previous</button>
        {Array.from({ length: totalPages }, (_, index) => index + 1).map(pageNumber => (
          <button key={pageNumber} onClick={() => handlePageClick(pageNumber)}>{pageNumber}</button>
        ))}
        <button onClick={handleNextPage} disabled={currentPage === totalPages}>Next</button>
      </div>
    </div>
  );
};

export default RealEstates;

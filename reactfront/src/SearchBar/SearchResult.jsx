import React,{useState,useEffect} from 'react';
import RealEstate from '../RealEstates/realEstate';
import { useLocation } from 'react-router-dom';
import { search } from '../Api/api';

const SearchResult = () => {

  const[searchResult,setSearchResult]=useState([]);
  const[currentPage,setCurrentPage]=useState(1);
  const[totalPages,setTotalPages]=useState(1);
  const location = useLocation();
  //get parametars from url
  const queryParams = new URLSearchParams(location.search);
  const searchTerm = queryParams.get('q');
  const selectedLocation = queryParams.get('location_name');
  const selectedOperator = queryParams.get('operator');
  const priceStart = queryParams.get('price_start');
  const priceEnd = queryParams.get('price_end');

  useEffect(() => {
    search(searchTerm, selectedLocation, selectedOperator, priceStart, priceEnd,currentPage).then((data) => {
      setSearchResult(data['realestates_details']['data']);
      setTotalPages(data['realestates_details']['last_page']);
    });
  }, [searchTerm, selectedLocation, selectedOperator, priceStart, priceEnd,currentPage]);

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
      <h1>Real Estates</h1>
      <div className="real-estate-grid">
      {searchResult?.map((estate) => (
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

export default SearchResult;
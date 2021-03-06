import React from "react";
import { Link } from "react-router-dom";

/**
 *crea una tarjeta dependiendo de los
 *datos que se le pase
 *
 * @param {*} { img, title, desc, id }
 * @returns Component
 */
const Card = ({ img, title, desc, id }) => {
  return (
    <div className="card mt-3 mb-4 pb-1">
      <Link to={`/posts/${id}`}>
        <img className="card-img-top" src={img} alt={title} />
      </Link>
      <div className="card-body">
        <h5 className="card-title">{title}</h5>
        <p className="card-text">{desc}</p>
      </div>
      <div className="text-center">
        <Link to={`/posts/${id}`} className="action">
          <i className="fa fa-arrow-circle-right"></i>
        </Link>
      </div>
    </div>
  );
};

export default Card;

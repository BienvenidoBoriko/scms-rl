import React from "react";
import Card from "./../card/card";

/**
 *crea un grupos de posts
 *recibe el arreglo con los posts
 *y el titulo del grupo
 *utiliza el componente Card
 *
 * @param {*} { posts, title }
 * @returns Component
 */
const CardList = ({ posts, title }) => {
  return (
    <div class="article-list">
      <div class="container">
        {title !== null ? <h1 style={{ "font-size": "30px" }}>{title}</h1> : ""}
        <div class="card-deck">
          {posts.map((post, index) => {
            return <Card key={index} img={post.featured_img} title={post.title} desc={post.custom_except} id={post.id} />;
          })}
        </div>
      </div>
    </div>
  );
};

export default CardList;

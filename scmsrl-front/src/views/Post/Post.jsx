import React, { Fragment, useState, useEffect } from "react";
import { BrowserRouter as Router, Switch, Route, Link, useParams } from "react-router-dom";
import { getPost } from "./../../utils/peticiones";
import PostHeader from "./../../components/post-header/post-header";
import PostContent from "./../../components/postContent/postContent";
import Loading from "./../../components/loading/loading";

const Post = (props) => {
  let { id } = useParams();
  const [post, setPost] = useState({});
  const [loading, setLoading] = useState(true);
  const getData = async () => {
    let post = {};
    post = await getPost(id)
      .then((res) => res.data)
      .then((data) => data.post[0]);
    setPost(post);
    setLoading(false);
    return post;
  };

  useEffect(() => {
    getData();
  }, []);

  return (() => {
    if (loading) {
      return (
        <div className="d-flex justify-content-center align-items-center">
          <Loading width="75" height="75" />
        </div>
      );
    } else {
      return (
        <Fragment>
          <PostHeader title={post.title} author={post.user.name} published_at={post.published_at} img={post.cover_img} />
          <PostContent content={post.html} />
        </Fragment>
      );
    }
  })();
};

export default Post;

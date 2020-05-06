import React, { Fragment, useState, useEffect } from "react";
import { getPosts, getCategories, getSettings, getTags } from "./../../utils/peticiones";
import NavBar from "./../../components/NavBar/NavBar";
import Header from "./../../components/header/header";
const Home = () => {
  const [data, setData] = useState({ posts: "", tags: "", categories: "", settings: "" });

  const getData = async () => {
    let datas = { posts: "", tags: "", categories: "", settings: "" };

    datas.settings = await getSettings()
      .then((res) => res.data)
      .then((data) => data.settings);
    datas.tags = await getTags()
      .then((res) => res.data)
      .then((data) => data.tags);
    datas.categories = await getCategories()
      .then((res) => res.data)
      .then((data) => data.categories);

    datas.posts = await getPosts()
      .then((res) => res.data)
      .then((data) => data.posts);
    setData(datas);
    return datas;
  };

  useEffect(() => {
    getData();
  }, []);
  return (
    <Fragment>
      <NavBar title={data.settings[0] != undefined ? data.settings[0].value : ""} categories={data.categories} tags={data.tags} />
      <Header
        title={data.settings[0] != undefined ? data.settings[0].value : ""}
        cover_img={data.settings[2] != undefined ? data.settings[2].value : ""}
        desc={data.settings[1] != undefined ? data.settings[1].value : ""}
      />
      <div>estamos en home</div>
    </Fragment>
  );
};

export default Home;

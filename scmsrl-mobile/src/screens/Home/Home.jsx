import React, { useEffect, useState } from "react";
import Header from "./../../components/header/header";
import CardList from "./../../components/cardList/cardList";
import {
  StyleSheet,
  SafeAreaView,
  View,
  Text,
  ScrollView,
  ActivityIndicator,
} from "react-native";
import {
  getPosts,
  getCategories,
  getSettings,
  getTags,
} from "./../../utils/peticiones";

const Home = ({ navigation: { navigate } }) => {
  const [data, setData] = useState({ posts: [], categories: [] });
  const [loading, setLoading] = useState(true);

  //obiene los datos
  const getData = async () => {
    let datas = { posts: [], categories: [] };
    datas.categories = await getCategories()
      .then((res) => res.data)
      .then((data) => data.categories);

    datas.posts = await getPosts()
      .then((res) => res.data)
      .then((data) => data.posts);
    setData(datas);
    setLoading(false);
    console.log("recarga");
    return datas;
  };

  useEffect(() => {
    getData();
  }, []);

  const reloadContent = () => {
    getData();
  };
  const get3Posts = (posts) => {
    let rPosts = [];
    for (let post of posts) {
      rPosts.push(post);
      if (rPosts.length === 3) break;
    }
    return rPosts;
  };

  const styles = StyleSheet.create({
    container: {
      flex: 1,
      backgroundColor: "#fff",
      alignItems: "center",
    },
    loading: {
      flex: 1,
    },
    contentContainer: {
      flexGrow: 1,
    },
    center: {
      alignItems: "center",
    },
    listItem: {
      margin: 5,
      padding: 5,
      width: "100%",
      flexDirection: "row",
      alignItems: "center",
    },
    bullet: {
      width: "10%",
    },
    text: {
      flex: 1,
      marginLeft: 5,
      fontWeight: "bold",
    },
    textDone: {
      color: "#aaa",
      textDecorationLine: "line-through",
      fontWeight: "normal",
    },
    delete: {
      width: 44,
      height: 44,
      alignItems: "center",
      justifyContent: "center",
    },
    emptyList: {
      flex: 1,
      justifyContent: "center",
      alignItems: "center",
    },
    separator: {
      height: 1,
      width: "86%",
      backgroundColor: "#CED0CE",
      marginLeft: "14%",
    },
    sectionHeader: {
      backgroundColor: "#ddd",
      padding: 10,
    },
    emptyImage: {
      width: 50,
      height: 50,
      tintColor: "#005500",
    },
    icon: {
      width: 20,
      height: 20,
    },
  });

  let postPerCategories = data.categories.map((category, index) => {
    return { title: category.name, data: category.posts };
  });

  return (
    <SafeAreaView style={styles.container}>
      {loading && (
        <ActivityIndicator
          style={styles.loading}
          size="large"
          color="#0066ff"
        />
      )}

      {!loading && (
        <ScrollView>
          <CardList
            data={[{ title: "Ultimas Entradas", data: get3Posts(data.posts) }]}
          />
          <CardList data={postPerCategories} />
        </ScrollView>
      )}
    </SafeAreaView>
  );
};

export default Home;

import React from "react";
import Header from "./../../components/header/header";
import CardList from "./../../components/cardList/cardList";
import {
  StyleSheet,
  SafeAreaView,
  View,
  Text,
  ActivityIndicator,
  Alert,
} from "react-native";

const Home = ({ settings = [], posts = [], categories = [], tags = [] }) => {
  const get3Posts = (posts) => {
    let rPosts = [];
    for (let post of posts) {
      rPosts.push(post);
      if (rPosts.length === 3) break;
    }
    return rPosts;
  };

  let loading = false;
  const styles = StyleSheet.create({
    container: {
      flex: 1,
      backgroundColor: "#fff",
      alignItems: "center",
    },
    loading: {
      flex: 1,
    },
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
      <Header
        title={settings[0] != undefined ? settings[0].value : ""}
        cover_img={settings[3] != undefined ? settings[3].value : ""}
        desc={settings[1] != undefined ? settings[1].value : ""}
      />

      {!loading && (
        <View>
          <CardList posts={get3Posts(posts)} title="Ultimas Entradas" />
          {categories.map((category, index) => {
            return (
              <CardList
                posts={get3Posts(category.posts)}
                title={category.name}
              />
            );
          })}
        </View>
      )}
    </SafeAreaView>
  );
};

export default Home;

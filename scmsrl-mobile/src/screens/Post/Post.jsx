import React, { useState, useEffect } from "react";
import { useRoute } from "@react-navigation/native";
import { getPost } from "./../../utils/peticiones";
import PostHeader from "./../../components/post-header/post-header";
import PostContent from "./../../components/postContent/postContent";
import {
  StyleSheet,
  SafeAreaView,
  View,
  ScrollView,
  Text,
  ActivityIndicator,
} from "react-native";

const Post = (props) => {
  const route = useRoute();
  let id = route.params.id;

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

  return (
    <SafeAreaView /* style={styles.container} */>
      {loading && (
        <ActivityIndicator
          /* style={styles.loading} */
          size="large"
          color="#0066ff"
        />
      )}

      {!loading && (
        <ScrollView>
          <PostHeader
            title={post.title}
            author={post.user.name}
            published_at={post.published_at}
            img={post.featured_img}
          />
          <PostContent content={post.html} />
        </ScrollView>
      )}
    </SafeAreaView>
  );
};

export default Post;

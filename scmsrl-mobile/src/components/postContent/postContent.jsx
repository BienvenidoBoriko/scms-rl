import React from "react";
import DOMParser from "react-native-html-parser";
import { StyleSheet, View, Text, ScrollView, Dimensions } from "react-native";
import HTML from "react-native-render-html";
/**
 *Muestra el contenido de un
 *posts
 *
 * @param {*} { content }
 * @returns
 */
const PostContent = ({ content }) => {
  const parser = new DOMParser.DOMParser();
  return (
    <View className="post-content">
      <View className="container">
        <View className="row">
          <View className="col-md-10 col-lg-8 mx-auto">
            <HTML
              html={content}
              imagesMaxWidth={Dimensions.get("window").width}
            />
          </View>
        </View>
      </View>
    </View>
  );
};

export default PostContent;

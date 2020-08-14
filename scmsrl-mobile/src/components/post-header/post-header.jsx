import React from "react";
import moment from "moment";
import "moment/locale/es";
import { StyleSheet, View, Text } from "react-native";
import { API_URL_SHORT } from "@env";

/**
 *cabecera para los posts
 *
 * @param {*} { title, author, published_at, img }
 * @returns
 */
const PostHeader = ({ title, author, published_at, img }) => {
  return (
    <View
    /* class="masthead" style={{
        "background-image": `url(${API_URL_SHORT}${img})`,
      }}*/
    >
      <View class="container">
        <View class="row">
          <View class="col-md-10 col-lg-8 mx-auto">
            <View class="post-heading">
              <Text>{title}</Text>
              {/* <h2 class="subheading">{desc}</h2> */}
              <Text class="meta">
                Publicado por {author} {moment(published_at).fromNow()}
              </Text>
            </View>
          </View>
        </View>
      </View>
    </View>
  );
};

export default PostHeader;

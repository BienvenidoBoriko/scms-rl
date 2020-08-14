import React from "react";
import Card from "./../card/card";
import {
  StyleSheet,
  Text,
  SectionList,
  View,
  TouchableOpacity,
} from "react-native";

/**
 *crea un grupos de posts
 *recibe el arreglo con los posts
 *y el titulo del grupo
 *utiliza el componente Card
 *
 * @param {*} { posts, title }
 * @returns Component
 */
const CardList = ({ data }) => {
  const styles = StyleSheet.create({
    container: {
      width: "100%",
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
  const renderItem = (post) => {
    return (
      <TouchableOpacity style={styles.listItem} key={post.id}>
        <Card
          img={post.featured_img}
          title={post.title}
          desc={post.custom_except}
          id={post.id}
        />
      </TouchableOpacity>
    );
  };

  const renderSeparator = () => {
    return <View style={styles.separator} />;
  };

  const renderEmptyComponent = () => {
    return (
      <View style={styles.emptyList}>
        <Text>Lista Vacia</Text>
      </View>
    );
  };
  return (
    <SectionList
      style={styles.container}
      sections={data}
      keyExtractor={(item, index) => item.name + index}
      renderItem={({ item }) => renderItem(item)}
      renderSectionHeader={({ section: { title } }) => {
        return (
          <View>
            <Text style={styles.text}>
              {title !== null ? (
                <Text style={{ "font-size": "30px" }}>{title}</Text>
              ) : (
                ""
              )}
            </Text>
          </View>
        );
      }}
      ItemSeparatorComponent={renderSeparator}
      ListEmptyComponent={renderEmptyComponent}
      stickySectionHeadersEnabled={true}
    />
  );
};

export default CardList;

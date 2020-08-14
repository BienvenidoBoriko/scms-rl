import React from "react";
import { StyleSheet, Text, View, Image } from "react-native";
import { FontAwesomeIcon } from "@fortawesome/react-native-fontawesome";
import { faArrowCircleRight } from "@fortawesome/free-solid-svg-icons";
import { useNavigation } from "@react-navigation/native";
//import { Link } from "react-router-dom";

/**
 *crea una tarjeta dependiendo de los
 *datos que se le pase
 *
 * @param {*} { img, title, desc, id }
 * @returns Component
 */
const Card = ({ img, title, desc, id }) => {
  const navigation = useNavigation();
  return (
    <View /* className="card mt-3 mb-4 pb-1" */>
      <Image
        /* className="card-img-top" */
        source={{ uri: img }}
        alt={title}
        onPress={() => navigation.navigate("Post", { id })}
      />
      <View /* className="card-body" */>
        <Text /* className="card-title" */>{title}</Text>
        <Text /* className="card-text" */>{desc}</Text>
      </View>
      <View /*className="text-center"*/>
        <View /*className="action"*/>
          <FontAwesomeIcon
            icon={faArrowCircleRight}
            onPress={() => navigation.navigate("Post", { id })}
          />
        </View>
      </View>
    </View>
  );
};

export default Card;

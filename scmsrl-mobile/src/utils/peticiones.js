import { API_URL, API_TOKEN } from "@env";

export const getPosts = async () => {
  return await fetch(`${API_URL}posts`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "Error al obtener los posts" };
    }
  });
};

export const getPost = async (id) => {
  return await fetch(`${API_URL}posts/${id}`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "Error no se ha encontrado el post" };
    }
  });
};

export const getTags = async () => {
  return await fetch(`${API_URL}tags`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "Error al obtener los tags" };
    }
  });
};

export const getTag = async (id) => {
  return await fetch(`${API_URL}tags/${id}`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "Error al obtener el tag" };
    }
  });
};

export const getCategories = async () => {
  return await fetch(`${API_URL}categories`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "Error al obtener las categorias" };
    }
  });
};

export const getCategory = async (id) => {
  return await fetch(`${API_URL}categories/${id}`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "Error no se ha encontrado la categoria" };
    }
  });
};

export const getSettings = async () => {
  return await fetch(`${API_URL}settings`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "Error al obtener los ajustes" };
    }
  });
};

export const getSetting = async (id) => {
  return await fetch(`${API_URL}settings/${id}`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "No se ha encontrado el ajuste" };
    }
  });
};

export const getUser = async (id) => {
  return await fetch(`${API_URL}users/${id}`, {
    method: "GET",
    headers: {
      Authorization: "Bearer " + API_TOKEN,
      "Content-type": "application/json",
    },
  }).then((res) => {
    if (res.status === 200) {
      return { status: true, data: res.json() };
    } else {
      return { status: false, data: "No se ha encontrado el usuario" };
    }
  });
};

# Instalacion 
npm install: Instalar las dependencias de node.
cp config.js.example config.js:Copiar archivo src/utils/config.js.example a src/utils/config.js.

vim config.js: Modificar archivo src/utils/config.js. En este fichero indicamos la dirección y puerto donde está el back y también el token de autenticación del api.

npm run build.
vim .htaccess: Crear fichero .htaccess en el directorio scmsrl-front/build para solucionar el problema que tiene react-router-dom al refrescar la página.

const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: [], 
})
// transpileDependencies: true


// module.exports = {
//   configureWebpack: {
//     optimization: {
//       splitChunks: {
//         chunks: 'all',
//         // ...các tùy chọn khác...
//       },
//     },
//   },
// };
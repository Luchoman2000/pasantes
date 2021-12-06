var server = document.location.origin;
window.addEventListener('load', function() {
  registerSW();
})

// if ('serviceWorker' in navigator) {
//   navigator.serviceWorker.register('./sw.js').then(function (reg) {
//     console.log('Service Worker Registered');
//   }).catch(function (err) {
//     console.log('Service Worker Failed to Register', err);
//   });
// }

// Register SW function
async function registerSW() {
  if ('serviceWorker' in navigator) {
    try {
      const reg = await navigator.serviceWorker.register(server + '/pasantes/sw.js');
      // console.log('SW registered');
    } catch (error) {
      console.log('SW failed to register\n' + error);
    }
  }
}
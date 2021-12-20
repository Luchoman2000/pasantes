var server = document.location.origin;

const applicationServerPublicKey = "";

// function initialiseUI() {
// 	// Set the initial subscription value
// 	swRegistration.pushManager.getSubscription().then(function (subscription) {
// 		isSubscribed = !(subscription === null);
// 		if (isSubscribed) {
// 			console.log('User IS subscribed.');
// 		} else {
// 			console.log('User is NOT subscribed.');
// 		}

// 		updateBtn();
// 	});
// }

// function updateBtn(){
// 	if(isSubscribed){
// 		pushButton.textContent = 'Disable Push Messaging';
// 	}else{
// 		pushButton.textContent = 'Enable Push Messaging';
// 	}
// }

// function subscribeUser(){
// 	const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
// 	swRegistration.pushManager.subscribe({
// 		userVisibleOnly: true,
// 		applicationServerKey: applicationServerKey
// 	}).then(function(subscription) {
// 		console.log('User is subscribed.', subscription);

// 		updateSubscriptionOnServer(subscription);

// 		isSubscribed = true;

// 		updateBtn();
// 	}).catch(function(err) {
// 		console.log('Failed to subscribe the user: ', err);
// 		updateBtn();
// 	});
// }


window.addEventListener('load', function () {
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
			console.log('SW registered');
			// initialiseUI();
			swRegistration = reg;
		} catch (error) {
			console.log('SW failed to register\n' + error);
		}
	}
	
}
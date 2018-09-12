/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
 
var iframe = document.getElementById('iframe-placeholder');
 
var app = {
    // Application Constructor
    initialize: function() {
        document.addEventListener('deviceready', this.onDeviceReady.bind(this), false);
    },

    // deviceready Event Handler
    //
    // Bind any cordova events here. Common events are:
    // 'pause', 'resume', etc.
	
    onDeviceReady: function() {
        //this.receivedEvent('deviceready');
		//alert("telephone pret");
		
		// Enable to debug issues.
		// window.plugins.OneSignal.setLogLevel({logLevel: 4, visualLevel: 4});
  
	    var notificationOpenedCallback = function(jsonData) {
		
			//alert('notificationOpenedCallback: ' + JSON.stringify(jsonData));
			
			//on teste l'existance de la valeur ayant pour clé key
			var lien = jsonData.notification.payload.additionalData.link;
			var download = jsonData.notification.payload.additionalData.download;
			
			if(typeof lien != "undefined" )
			{
				iframe.src = lien;
				
			} 
			
			if(typeof download != "undefined" )
			{
				//var strWindowFeatures = "location=yes,height=570,width=520,scrollbars=yes,status=yes";
				var strWindowFeatures = "";
				var URL = download;
				var win = window.open(URL, "_blank", strWindowFeatures);
				
			} 
			
			
			//alert(jsonData.notification.payload.additionalData.link);
			
		};

		window.plugins.OneSignal
		.startInit("fbf56692-9225-4dba-8451-748abfe8a23d")
		.handleNotificationOpened(notificationOpenedCallback)
		.endInit();
		
    },

    // Update DOM on a Received Event
    /* receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
		
		
		
    } */
};


app.initialize();


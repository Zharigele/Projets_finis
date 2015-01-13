package com.example.test1;

import org.apache.cordova.DroidGap;

import android.os.Bundle;

public class MainActivity extends DroidGap {
	
	//   http://api.ign.fr/jsp/site/Portal.jsp?page_id=6&document_id=205&dossier_id=53
	

	@Override
	public void onCreate(Bundle savedInstanceState){
		super.onCreate(savedInstanceState);
	super.loadUrl("file:///android_asset/www/index.html");
	}
}
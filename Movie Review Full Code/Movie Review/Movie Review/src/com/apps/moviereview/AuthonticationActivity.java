package com.apps.moviereview;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import com.apps.moviereview.R;

public class AuthonticationActivity extends ActionBarActivity {

	Toolbar toolbar;

	@Override
	protected void onCreate(Bundle arg0) {
		// TODO Auto-generated method stub
		super.onCreate(arg0);
		setContentView(R.layout.activity_authenticate);
		toolbar = (android.support.v7.widget.Toolbar) this.findViewById(R.id.toolbar);
		//toolbar.setTitle(R.string.app_name);
		this.setSupportActionBar(toolbar);
		getSupportActionBar().setDisplayHomeAsUpEnabled(true);
		getSupportActionBar().setDisplayShowHomeEnabled(true);

	}

	public void SignUpClicked(View view) {
		Intent intsignup=new Intent(AuthonticationActivity.this,SignUpActivity.class);
		intsignup.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		startActivity(intsignup);
	}


	public void SignInClicked(View view) {
		Intent intsignin=new Intent(AuthonticationActivity.this,SignInActivity.class);
		intsignin.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		startActivity(intsignin);
		finish();
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem menuItem)
	{       
		switch (menuItem.getItemId()) 
		{
		case android.R.id.home: 
			onBackPressed();
			break;

		default:
			return super.onOptionsItemSelected(menuItem);
		}
		return true;
	}


}

package com.apps.moviereview;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.widget.SearchView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;
import android.widget.Toast;

import com.example.adapter.ActorList_Adapter;
import com.example.item.Item_ActorList;
import com.example.util.AlertDialogManager;
import com.example.util.Constant;
import com.example.util.JsonUtils;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;

public class ActorListActivity extends ActionBarActivity {

	ListView lsv_cat;
	List<Item_ActorList> arrayOfmovieList;
	ActorList_Adapter objAdapter;
	AlertDialogManager alert = new AlertDialogManager();
	private Item_ActorList objAllBean;
	JsonUtils util;
	int textlength = 0;
	Toolbar toolbar;
	private AdView mAdView;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.movielist_activity);
		toolbar = (android.support.v7.widget.Toolbar) this.findViewById(R.id.toolbar);
		toolbar.setTitle(Constant.ACTORCAT_NAMEE);
		this.setSupportActionBar(toolbar);
		getSupportActionBar().setDisplayHomeAsUpEnabled(true);
		getSupportActionBar().setDisplayShowHomeEnabled(true);

		mAdView = (AdView) findViewById(R.id.adView);
		mAdView.loadAd(new AdRequest.Builder().build());

		lsv_cat=(ListView)findViewById(R.id.lsv_catlist);

		arrayOfmovieList=new ArrayList<Item_ActorList>();


		util=new JsonUtils(getApplicationContext());

		if (JsonUtils.isNetworkAvailable(ActorListActivity.this)) {
			new MyTask().execute(Constant.ACTORLIST_URL+Constant.ACTORCAT_IDD);
		} else {
			showToast("No Network Connection!!!");
			alert.showAlertDialog(ActorListActivity.this, "Internet Connection Error",
					"Please connect to working Internet connection", false);
		}

		lsv_cat.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int position,
					long arg3) {
				// TODO Auto-generated method stub

				objAllBean=arrayOfmovieList.get(position);
				Constant.CATEGORYLIST_IDD=objAllBean.getActorLID();
				Intent intdetail=new Intent(getApplicationContext(),MovieDetailsActivity.class);
				startActivity(intdetail);

			}
		});

	}

	private	class MyTask extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(ActorListActivity.this);
			pDialog.setMessage("Loading...");
			pDialog.setCancelable(false);
			pDialog.show();
		}

		@Override
		protected String doInBackground(String... params) {
			return JsonUtils.getJSONString(params[0]);
		}

		@Override
		protected void onPostExecute(String result) {
			super.onPostExecute(result);

			if (null != pDialog && pDialog.isShowing()) {
				pDialog.dismiss();
			}

			if (null == result || result.length() == 0) {
				showToast("Server Connection Error");
				alert.showAlertDialog(ActorListActivity.this, "Server Connection Error",
						"May Server Under Maintaines Or Low Network", false);

			} else {

				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.CATEGORY_ARRAY_NAME);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);

						Item_ActorList objItem = new Item_ActorList();

						objItem.setActorLID(objJson.getString(Constant.ACTORLIST_ID));
						objItem.setActorLCID(objJson.getString(Constant.ACTORLIST_CID));
						objItem.setActorLGID(objJson.getString(Constant.ACTORLIST_GID));
						objItem.setActorLTITLE(objJson.getString(Constant.ACTORLIST_TITLE));
						objItem.setActorLMCAST(objJson.getString(Constant.ACTORLIST_MCAST));
						objItem.setActorLMIMG(objJson.getString(Constant.ACTORLIST_MIMG));
						objItem.setActorLMDESC(objJson.getString(Constant.ACTORLIST_MDESC));
						objItem.setActorLMDATE(objJson.getString(Constant.ACTORLIST_MDATE));
						objItem.setActorLMVIEW(objJson.getString(Constant.ACTORLIST_MVIEW));
						objItem.setActorLMRATE(objJson.getString(Constant.ACTORLIST_MRATE));


						arrayOfmovieList.add(objItem);


					}

				} catch (JSONException e) {
					e.printStackTrace();
				}

				setAdapterToListview();
			}

		}
	}

	public void setAdapterToListview() {
		objAdapter = new ActorList_Adapter(ActorListActivity.this, R.layout.item_movielist,
				arrayOfmovieList);
		lsv_cat.setAdapter(objAdapter);


	}

	public void showToast(String msg) {
		Toast.makeText(ActorListActivity.this, msg, Toast.LENGTH_LONG).show();
	}


	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// TODO Auto-generated method stub

		MenuInflater inflater = getMenuInflater();
		inflater.inflate(R.menu.search_menu, menu);

		final SearchView searchView = (SearchView) menu.findItem(R.id.search)
				.getActionView();

		final MenuItem searchMenuItem = menu.findItem(R.id.search);
		searchView.setOnQueryTextFocusChangeListener(new View.OnFocusChangeListener() {

			@Override
			public void onFocusChange(View v, boolean hasFocus) {
				// TODO Auto-generated method stub
				if(!hasFocus) {
					searchMenuItem.collapseActionView();
					searchView.setQuery("", false);
				}
			}
		});


		searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
			@Override
			public boolean onQueryTextChange(String newText) {

				String text = newText.toString().toLowerCase(Locale.getDefault());
				if(objAdapter!=null)
				{
					objAdapter.filter(text);
				}

				return false;
			}

			@Override
			public boolean onQueryTextSubmit(String query) {
				// Do something
				return true;
			}
		});
		return super.onCreateOptionsMenu(menu);


	}

	@Override
	public boolean onOptionsItemSelected(MenuItem menuItem)
	{       
		switch (menuItem.getItemId()) 
		{
		case android.R.id.home: 
			onBackPressed();
			return true;

		default:
			return super.onOptionsItemSelected(menuItem);
		}


	}

	@Override
	protected void onPause() {
		//	mAdView.pause();
		super.onPause();
	}

	@Override
	protected void onResume() {
		super.onResume();
		//	mAdView.resume();
	}

	@Override
	protected void onDestroy() {
		//mAdView.destroy();
		super.onDestroy();
	}

}

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
import com.apps.moviereview.R;
import com.example.adapter.GenresCat_Adapter;
import com.example.item.Item_GenresCat;
import com.example.util.AlertDialogManager;
import com.example.util.Constant;
import com.example.util.JsonUtils;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.startapp.android.publish.StartAppAd;

public class GenresCatActivity extends ActionBarActivity {

	ListView lsv_actorcat;
	List<Item_GenresCat> arrayOfactorcat;
	GenresCat_Adapter objAdapteractorcat;
	AlertDialogManager alert = new AlertDialogManager();
	private Item_GenresCat objAllBeanactorcat;
	JsonUtils util;
	int textlength = 0;
	Toolbar toolbar;
	private AdView mAdView;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		StartAppAd.init(this, getString(R.string.startapp_dev_id), getString(R.string.startapp_app_id,false));
		setContentView(R.layout.genres_activity);
		toolbar = (android.support.v7.widget.Toolbar) this.findViewById(R.id.toolbar);
		toolbar.setTitle("Genres");
		this.setSupportActionBar(toolbar);
		getSupportActionBar().setDisplayHomeAsUpEnabled(true);
		getSupportActionBar().setDisplayShowHomeEnabled(true);

		StartAppAd.showSlider(this);
		mAdView = (AdView) findViewById(R.id.adView);
		mAdView.loadAd(new AdRequest.Builder().build());

		lsv_actorcat=(ListView)findViewById(R.id.lsv_genrescat);
		arrayOfactorcat=new ArrayList<Item_GenresCat>();


		util=new JsonUtils(getApplicationContext());

		if (JsonUtils.isNetworkAvailable(GenresCatActivity.this)) {
			new MyTask().execute(Constant.GENRESCAT_URL);
		} else {
			showToast("No Network Connection!!!");
			alert.showAlertDialog(GenresCatActivity.this, "Internet Connection Error",
					"Please connect to working Internet connection", false);
		}

		lsv_actorcat.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int position,
					long arg3) {
				// TODO Auto-generated method stub

				objAllBeanactorcat=arrayOfactorcat.get(position);
				Constant.GENRESCAT_IDD=objAllBeanactorcat.getGenresCatId();
				Constant.GENRESCAT_NAMEE=objAllBeanactorcat.getGenresCatName();

				Intent intdetail=new Intent(GenresCatActivity.this,GenresListActivity.class);
				startActivity(intdetail);

			}
		});

	}

	private	class MyTask extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(GenresCatActivity.this);
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
				alert.showAlertDialog(GenresCatActivity.this, "Server Connection Error",
						"May Server Under Maintaines Or Low Network", false);

			} else {

				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.CATEGORY_ARRAY_NAME);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);

						Item_GenresCat objItem = new Item_GenresCat();

						objItem.setGenresCatId(objJson.getString(Constant.GENRESCAT_ID));
						objItem.setGenresCatName(objJson.getString(Constant.GENRESCAT_NAME));

						arrayOfactorcat.add(objItem);


					}

				} catch (JSONException e) {
					e.printStackTrace();
				}

				setAdapterToListview();
			}

		}
	}

	public void setAdapterToListview() {
		objAdapteractorcat = new GenresCat_Adapter(GenresCatActivity.this, R.layout.item_moviecat,
				arrayOfactorcat);
		lsv_actorcat.setAdapter(objAdapteractorcat);


	}

	public void showToast(String msg) {
		Toast.makeText(GenresCatActivity.this, msg, Toast.LENGTH_LONG).show();
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
				if(objAdapteractorcat!=null)
				{
					objAdapteractorcat.filter(text);
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

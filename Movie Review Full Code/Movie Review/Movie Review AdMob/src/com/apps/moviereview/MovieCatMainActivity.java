package com.apps.moviereview;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBar;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.SearchView;
import android.support.v7.widget.Toolbar;
import android.view.KeyEvent;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.example.adapter.Drawer_Adapter;
import com.example.adapter.MovieCat_Adapter;
import com.example.item.Item_Drawer;
import com.example.item.Item_MovieCat;
import com.example.util.AlertDialogManager;
import com.example.util.Constant;
import com.example.util.JsonUtils;
import com.example.util.SessionManager;
import com.google.android.gms.ads.AdListener;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.InterstitialAd;

public class MovieCatMainActivity extends ActionBarActivity {

	Toolbar toolbar;
	ProgressBar pbar;
	ListView lsv_latest;
	AlertDialogManager alert = new AlertDialogManager();
	ListView mDrawerList;
	DrawerLayout mDrawerLayout;
	ActionBarDrawerToggle mDrawerToggle;
	private CharSequence mDrawerTitle;
	private CharSequence mTitle;
	List<Item_Drawer> arraydrawer;
	Drawer_Adapter adapter;

	List<Item_MovieCat> arrayOfCategory;
	MovieCat_Adapter objAdapterCategory;
	private Item_MovieCat objAllBean;
	private AdView mAdView;
	private InterstitialAd mInterstitial;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.moviecat_mainactivity);
		toolbar = (android.support.v7.widget.Toolbar) this.findViewById(R.id.toolbar);
		toolbar.setTitle(getString(R.string.app_name));
		this.setSupportActionBar(toolbar);
		// Set the menu icon instead of the launcher icon.
		final ActionBar ab = getSupportActionBar();
		ab.setHomeAsUpIndicator(R.drawable.sidebar_nav_icon);


		mAdView = (AdView) findViewById(R.id.adView);
		mAdView.loadAd(new AdRequest.Builder().build());

		mInterstitial = new InterstitialAd(this);
		mInterstitial.setAdUnitId(getResources().getString(R.string.admob_intertestial_id));
		mInterstitial.loadAd(new AdRequest.Builder().build());

		mInterstitial.setAdListener(new AdListener() {
			@Override
			public void onAdLoaded() {
				// TODO Auto-generated method stub
				super.onAdLoaded();
				if (mInterstitial.isLoaded()) {
					mInterstitial.show();
				}
			}
		});

		pbar=(ProgressBar)findViewById(R.id.progressBar1);
		lsv_latest=(ListView)findViewById(R.id.lsv_latest);
		arrayOfCategory=new ArrayList<Item_MovieCat>();


		mTitle = mDrawerTitle = getTitle();
		mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
		mDrawerList = (ListView) findViewById(R.id.left_drawer);
		arraydrawer=new ArrayList<Item_Drawer>();

		View header = getLayoutInflater().inflate(R.layout.left_nav_header,
				null);
		mDrawerList.addHeaderView(header);

		Item_Drawer recentAlbum = new Item_Drawer(1,"Actors",R.drawable.actors_icon);
		Item_Drawer recentAlbum2 = new Item_Drawer(2,"Geners",R.drawable.geners_icon);
		Item_Drawer recentAlbum3 = new Item_Drawer(3,"Rate App",R.drawable.rate_app_icon);
		Item_Drawer recentAlbum4 = new Item_Drawer(4,"More App",R.drawable.more_app_icon);
		Item_Drawer recentAlbum5 = new Item_Drawer(5,"About Us",R.drawable.about_icon);
		Item_Drawer recentAlbum6;

		if(isLogin())
		{
			recentAlbum6 = new Item_Drawer(6,"Logout",R.drawable.logout_icon);	
		}
		else
		{
			recentAlbum6 = new Item_Drawer(6,"Login",R.drawable.login_icon);
		}


		arraydrawer.add(0, recentAlbum);
		arraydrawer.add(1, recentAlbum2);
		arraydrawer.add(2, recentAlbum3);
		arraydrawer.add(3, recentAlbum4);
		arraydrawer.add(4,recentAlbum5);
		arraydrawer.add(5,recentAlbum6);


		//getSupportActionBar().setDisplayHomeAsUpEnabled(true);
		adapter = new Drawer_Adapter(MovieCatMainActivity.this, R.layout.drawer_item,
				arraydrawer);
		mDrawerList.setAdapter(adapter);


		if (JsonUtils.isNetworkAvailable(MovieCatMainActivity.this)) {
			new MyTask().execute(Constant.MOVIECAT_URL);
		} else {
			showToast(getString(R.string.conn_msg3));
			alert.showAlertDialog(MovieCatMainActivity.this, getString(R.string.conn_msg4),
					getString(R.string.conn_msg2), false);
		}


		lsv_latest.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				// TODO Auto-generated method stub
				objAllBean=arrayOfCategory.get(position);
				Constant.CATEGORY_IDD=objAllBean.getCatId();
				Constant.CATEGORY_NAMEE=objAllBean.getCategoryName();
				Intent intentlist=new Intent(MovieCatMainActivity.this,MovieListActivity.class);
				startActivity(intentlist);

			}
		});

		// set a custom shadow that overlays the main content when the drawer
		// opens
		mDrawerLayout.setDrawerShadow(R.drawable.drawer_shadow,
				GravityCompat.START);

		// ActionBarDrawerToggle ties together the the proper interactions
		// between the sliding drawer and the action bar app icon
		mDrawerToggle = new ActionBarDrawerToggle(this,
				mDrawerLayout, 
				toolbar,
				R.string.drawer_open,
				R.string.drawer_close
				) {
			public void onDrawerClosed(View view) {
				getSupportActionBar().setTitle(mTitle);
				// creates call to
				// onPrepareOptionsMenu()
			}

			public void onDrawerOpened(View drawerView) {
				getSupportActionBar().setTitle(mDrawerTitle);
				drawerView.bringToFront();
				// creates call to
				// onPrepareOptionsMenu()
			}
		};

		mDrawerLayout.setDrawerListener(mDrawerToggle);

		mDrawerList.setOnItemClickListener(new DrawerItemClickListener());
		//		// enable ActionBar app icon to behave as action to toggle nav drawer

	}


	private class DrawerItemClickListener implements
	ListView.OnItemClickListener {
		@Override
		public void onItemClick(AdapterView<?> parent, View view, int position,
				long id) {
			// TODO Auto-generated method stub
			//	Toast.makeText(getApplicationContext(), ""+position, Toast.LENGTH_SHORT).show();
			if(position==1)
			{
				Intent intentactor=new Intent(MovieCatMainActivity.this,ActorCatActivity.class);
				mDrawerLayout.closeDrawer(mDrawerList);
				startActivity(intentactor);
			}

			else if(position==2)
			{
				Intent intentgenres=new Intent(MovieCatMainActivity.this,GenresCatActivity.class);
				mDrawerLayout.closeDrawer(mDrawerList);
				startActivity(intentgenres);
			}
			else if(position==3)
			{
				final String appName = getPackageName();//your application package name i.e play store application url
				try {
					startActivity(new Intent(Intent.ACTION_VIEW,
							Uri.parse("market://details?id="
									+ appName)));
					mDrawerLayout.closeDrawer(mDrawerList);
				} catch (android.content.ActivityNotFoundException anfe) {
					startActivity(new Intent(
							Intent.ACTION_VIEW,
							Uri.parse("http://play.google.com/store/apps/details?id="
									+ appName)));

				}
			}
			else if(position==4)
			{
				startActivity(new Intent(
						Intent.ACTION_VIEW,
						Uri.parse(getString(R.string.play_more_apps))));
				mDrawerLayout.closeDrawer(mDrawerList);
			}
			else if(position==5)
			{
				Intent intentabout=new Intent(MovieCatMainActivity.this,AboutActivity.class);
				mDrawerLayout.closeDrawer(mDrawerList);
				startActivity(intentabout);
			}
			else if(position==6)
			{
				if(isLogin())
				{
					Logout();	
				}
				else
				{
					Intent up_wall=new Intent(getApplicationContext(),AuthonticationActivity.class);
					up_wall.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
					mDrawerLayout.closeDrawer(mDrawerList);
					startActivity(up_wall);	
					Constant.LOGIN_FORM="Main";

				}
			}


		}
	}

	public void checkLogin(){
		// Check login status
		SessionManager sessionManager=new SessionManager(getApplicationContext());
		if(!sessionManager.isLoggedIn()){
			// user is not logged in redirect him to Login Activity
			Intent i = new Intent(getApplicationContext(), AuthonticationActivity.class);
			// Closing all the Activities
			i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

			// Add new Flag to start new Activity
			i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

			// Staring Login Activity
			startActivity(i);
			finish();
		}

	}

	public boolean isLogin() {

		SessionManager sessionManager=new SessionManager(getApplicationContext());
		return sessionManager.isLoggedIn();
	}

	public void Logout() {

		SharedPreferences pref = getSharedPreferences(SessionManager.PREF_NAME, SessionManager.PRIVATE_MODE);
		Editor	editor = pref.edit();
		editor.clear();
		editor.commit();

		// After logout redirect user to Loing Activity
		Intent i = new Intent(getApplicationContext(), MovieCatMainActivity.class);
		// Closing all the Activities
		i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

		// Add new Flag to start new Activity
		i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

		// Staring Login Activity
		startActivity(i);

		finish();
	}

	private	class MyTask extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(MovieCatMainActivity.this);
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
				alert.showAlertDialog(getApplicationContext(), "Server Connection Error",
						"May Server Under Maintaines Or Low Network", false);

			} else {

				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.CATEGORY_ARRAY_NAME);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);

						Item_MovieCat objItem = new Item_MovieCat();


						objItem.setCatId(objJson.getString(Constant.CATEGORY_CID));
						objItem.setCategoryName(objJson.getString(Constant.CATEGORY_NAME));

						arrayOfCategory.add(objItem);


					}

				} catch (JSONException e) {
					e.printStackTrace();
				}

				setAdapterToListview();
			}

		}
	}



	public void setAdapterToListview() {
		objAdapterCategory = new MovieCat_Adapter(getApplicationContext(), R.layout.item_moviecat,
				arrayOfCategory);
		lsv_latest.setAdapter(objAdapterCategory);
	}

	public void showToast(String msg) {
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
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
				if(objAdapterCategory!=null)
				{
					objAdapterCategory.filter(text);
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
	public boolean onKeyDown(int keyCode, KeyEvent event) {


		if (keyCode == KeyEvent.KEYCODE_BACK) {
			// Toast.makeText(appContext, "BAck", Toast.LENGTH_LONG).show();
			AlertDialog.Builder alert = new AlertDialog.Builder(
					MovieCatMainActivity.this);
			alert.setTitle(R.string.app_name);
			alert.setIcon(R.drawable.app_icon);
			alert.setMessage("Are You Sure You Want To Quit?");

			alert.setPositiveButton("Ok",
					new DialogInterface.OnClickListener() {
				public void onClick(DialogInterface dialog,
						int whichButton) {

					finish();
				}

			});

			alert.setNegativeButton("Rate App",
					new DialogInterface.OnClickListener() {

				public void onClick(DialogInterface dialog, int which) {

					final String appName = getPackageName();
					try {
						startActivity(new Intent(Intent.ACTION_VIEW,
								Uri.parse("market://details?id="
										+ appName)));
					} catch (android.content.ActivityNotFoundException anfe) {
						startActivity(new Intent(
								Intent.ACTION_VIEW,
								Uri.parse("http://play.google.com/store/apps/details?id="
										+ appName)));
					}
				}
			});
			alert.show();
			return true;
		}

		return super.onKeyDown(keyCode, event);
	}
}
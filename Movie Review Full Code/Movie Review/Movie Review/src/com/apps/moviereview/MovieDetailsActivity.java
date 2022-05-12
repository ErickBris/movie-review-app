package com.apps.moviereview;

import java.util.ArrayList;
import java.util.List;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.Settings.Secure;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.webkit.WebView;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RatingBar;
import android.widget.RatingBar.OnRatingBarChangeListener;
import android.widget.TextView;
import android.widget.Toast;
import com.apps.moviereview.R;
import com.example.imageloader.ImageLoader;
import com.example.item.ItemRelated;
import com.example.item.Item_MovieList;
import com.example.util.AlertDialogManager;
import com.example.util.Constant;
import com.example.util.JsonUtils;
import com.example.util.SessionManager;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.startapp.android.publish.StartAppAd;

public class MovieDetailsActivity extends ActionBarActivity{

	Toolbar toolbar;
	TextView txt_mname,txt_mdate,txt_mcast,txt_mview;
	WebView webmdetail;
	ImageView img_moview;
	int position;
	String Id,mid,mcid,mgid,mtitle,mcast,mimg,mdesc,mdate,mview,mrate;
	AlertDialogManager alert = new AlertDialogManager();
	public ImageLoader imageLoader; 
	List<Item_MovieList> arrayOfHome;
	Item_MovieList objAllBean;
	List<ItemRelated> arrayofRelated;
	ItemRelated objChildBean;
	LinearLayout linear,linearContent;
	ProgressBar pbar;
	String rate_msg;
	private AdView mAdView;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		StartAppAd.init(this, getString(R.string.startapp_dev_id), getString(R.string.startapp_app_id,false));
		setContentView(R.layout.moviedetail_activity);
		toolbar = (android.support.v7.widget.Toolbar) this.findViewById(R.id.toolbar);
		//toolbar.setTitle(Constant.CATEGORY_NAMEE);
		this.setSupportActionBar(toolbar);
		getSupportActionBar().setDisplayHomeAsUpEnabled(true);
		getSupportActionBar().setDisplayShowHomeEnabled(true);
		imageLoader=new ImageLoader(MovieDetailsActivity.this);

		StartAppAd.showSlider(this);
		mAdView = (AdView) findViewById(R.id.adView);
		mAdView.loadAd(new AdRequest.Builder().build());

		Constant.DEVICE_ID=Secure.getString(MovieDetailsActivity.this.getContentResolver(),
				Secure.ANDROID_ID);
		//Log.e("Device Id", Constant.DEVICE_ID);

		txt_mname=(TextView)findViewById(R.id.txt_mname);
		txt_mdate=(TextView)findViewById(R.id.txt_mdate);
		txt_mcast=(TextView)findViewById(R.id.txt_mcast);
		txt_mview=(TextView)findViewById(R.id.txt_mview);
		img_moview=(ImageView)findViewById(R.id.img_mvoiew);
		webmdetail=(WebView)findViewById(R.id.webView1);
		linear=(LinearLayout)findViewById(R.id.content);
		linearContent=(LinearLayout)findViewById(R.id.rel_c_content);

		arrayOfHome=new ArrayList<Item_MovieList>();
		arrayofRelated=new ArrayList<ItemRelated>();

		if (JsonUtils.isNetworkAvailable(MovieDetailsActivity.this)) {
			new MyTask().execute(Constant.SINGLEMOVIE_URL+Constant.CATEGORYLIST_IDD);
		} else {
			showToast(getString(R.string.conn_msg3));
			alert.showAlertDialog(MovieDetailsActivity.this, getString(R.string.conn_msg4),
					getString(R.string.conn_msg2), false);
		}

		if (JsonUtils.isNetworkAvailable(MovieDetailsActivity.this)) {
			new MyTaskView().execute(Constant.VIEWCOUNT_URL+Constant.DEVICE_ID+"&movie_id="+Constant.CATEGORYLIST_IDD);
			//Log.e("rate", ""+Constant.RATING_URL+Constant.DEVICE_ID+"&movie_id="+Constant.CATEGORYLIST_IDD);
		} else {
			showToast("No Network Connection!!!");
			alert.showAlertDialog(MovieDetailsActivity.this, "Internet Connection Error",
					"Please connect to working Internet connection", false);
		}	 

	}

	private	class MyTask extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(MovieDetailsActivity.this);
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
				alert.showAlertDialog(MovieDetailsActivity.this, "Server Connection Error",
						"May Server Under Maintaines Or Low Network", false);

			} else {

				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.CATEGORY_ARRAY_NAME);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);

						Item_MovieList objItem = new Item_MovieList();

						objItem.setCLID(objJson.getString(Constant.CATEGORYLIST_ID));
						objItem.setCLCID(objJson.getString(Constant.CATEGORYLIST_CID));
						objItem.setCLGID(objJson.getString(Constant.CATEGORYLIST_GID));
						objItem.setCLTITLE(objJson.getString(Constant.CATEGORYLIST_TITLE));
						objItem.setCLMCAST(objJson.getString(Constant.CATEGORYLIST_MCAST));
						objItem.setCLMIMG(objJson.getString(Constant.CATEGORYLIST_MIMG));
						objItem.setCLMDESC(objJson.getString(Constant.CATEGORYLIST_MDESC));
						objItem.setCLMDATE(objJson.getString(Constant.CATEGORYLIST_MDATE));
						objItem.setCLMVIEW(objJson.getString(Constant.CATEGORYLIST_MVIEW));
						objItem.setCLMRATE(objJson.getString(Constant.CATEGORYLIST_MRATE));

						arrayOfHome.add(objItem);

						JSONArray jsonArraychild = objJson.getJSONArray(Constant.RELATED_ITEM_ARRAY_NAME);
						if(jsonArraychild.length()==0)
						{

						}
						else
						{
							for(int j=0 ;j< jsonArraychild.length();j++)
							{
								JSONObject objChild = jsonArraychild.getJSONObject(j);
								ItemRelated item=new ItemRelated();
								item.setRelatedId(objChild.getString(Constant.RELATED_ITEM_MID));
								item.setRelatedTitle(objChild.getString(Constant.RELATED_ITEM_MNAME));
								item.setRelatedImage(objChild.getString(Constant.RELATED_ITEM_MTHUMB));
								arrayofRelated.add(item);
							}
						}

					}

				} catch (JSONException e) {
					e.printStackTrace();
				}

				setAdapterToListview();
			}

		}
	}

	public void setAdapterToListview() {

		objAllBean=arrayOfHome.get(0);
		mid=objAllBean.getCLID();
		mcid=objAllBean.getCLCID();
		mgid=objAllBean.getCLGID();
		mtitle=objAllBean.getCLTITLE();
		mcast=objAllBean.getCLMCAST();
		mimg=objAllBean.getCLMIMG();
		mdesc=objAllBean.getCLMDESC();
		mdate=objAllBean.getCLMDATE();
		mview=objAllBean.getCLMVIEW();
		mrate=objAllBean.getCLMRATE();

		txt_mname.setText(mtitle);
		txt_mdate.setText(mdate);
		txt_mcast.setText(mcast);
		txt_mview.setText(mview);

		imageLoader.DisplayImage(Constant.SERVER_IMAGE_UPFOLDER_THUMB+mimg,img_moview);

		webmdetail.setBackgroundColor(Color.parseColor("#ffffff"));
		webmdetail.getSettings().setBuiltInZoomControls(true);
		webmdetail.getSettings().setDefaultTextEncodingName("UTF-8");
		String mimeType = "text/html";
		String encoding = "utf-8";
		String htmlText = mdesc;

		String text = "<html><head>"
				+ "<style type=\"text/css\">body{color: #000000;}"
				+ "</style></head>"
				+ "<body>"                          
				+  htmlText
				+ "</body></html>";

		webmdetail.loadData(text, mimeType, encoding);

		if(arrayofRelated.size()==0)
		{
			linearContent.removeAllViews();
			TextView txt=new TextView(MovieDetailsActivity.this);
			txt.setText("Related content does not found.");
			txt.setTextColor(getResources().getColor(R.color.black));
			txt.setTextSize(16f);
			linearContent.addView(txt);
		}
		else
		{
			RelatedContent();	
		}

	}
	public void RelatedContent()
	{
		linearContent.removeAllViews();
		int i=0;
		do
		{
			if(i>=arrayofRelated.size())
			{
				return;
			}

			View view = getLayoutInflater().inflate(R.layout.related_content, null);
			final ImageView imageView = (ImageView)view.findViewById(R.id.img_rela);
			final TextView txt_relmname=(TextView)view.findViewById(R.id.text_relmname);
			imageView.setId(i);

			linearContent.addView(view);
			objChildBean=arrayofRelated.get(i);
			imageLoader.DisplayImage(Constant.SERVER_IMAGE_THUMB+objChildBean.getRelatedImage().toString(), imageView);
			txt_relmname.setText(objChildBean.getRelatedTitle().toString());

			imageView.setOnClickListener(new View.OnClickListener() {

				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					objChildBean=arrayofRelated.get(imageView.getId());
					Intent intdetials=new Intent(MovieDetailsActivity.this,MovieDetailsActivity.class);
					intdetials.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
					Constant.CATEGORYLIST_IDD=objChildBean.getRelatedId();
					//Constant.SINGLE_CHANNEL=objChildBean.getRelatedTitle();
					startActivity(intdetials);
					finish();
				}
			});
			i++;
		}while(true);
	}

	public void showToast(String msg) {
		Toast.makeText(MovieDetailsActivity.this, msg, Toast.LENGTH_LONG).show();

	}
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		MenuInflater inflater = getMenuInflater();
		inflater.inflate(R.menu.detail_menu, menu);

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

		case R.id.rating:

			final Dialog dialog = new Dialog(MovieDetailsActivity.this);
			dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
			dialog.setContentView(R.layout.ratedialog);
			dialog.getWindow().setBackgroundDrawable(new ColorDrawable(android.graphics.Color.TRANSPARENT));

			final TextView txtrate=(TextView)dialog.findViewById(R.id.textView1);
			Button btnrate=(Button)dialog.findViewById(R.id.button1);
			RatingBar rating=(RatingBar)dialog.findViewById(R.id.ratingBar1);

			rating.setOnRatingBarChangeListener(new OnRatingBarChangeListener() {

				@Override
				public void onRatingChanged(RatingBar ratingBar, float rating,
						boolean fromUser) {
					// TODO Auto-generated method stub
					txtrate.setText(String.valueOf(rating));
				}
			});


			btnrate.setOnClickListener(new View.OnClickListener() {

				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub


					if(txtrate.getText().toString().equalsIgnoreCase(""))
					{
						showToast("Please Select AtLeast one Star");
					}
					else
					{
						dialog.dismiss();

						if (JsonUtils.isNetworkAvailable(MovieDetailsActivity.this)) {
							new MyTaskRating().execute(Constant.RATING_URL+Constant.DEVICE_ID+"&rate="+txtrate.getText().toString()+"&movie_id="+mid);
							//Log.e("rate", ""+Constant.RATING_URL+Constant.DEVICE_ID+"&rate="+txtrate.getText().toString()+"&movie_id="+mid);
						} else {
							showToast("No Network Connection!!!");
							alert.showAlertDialog(MovieDetailsActivity.this, "Internet Connection Error",
									"Please connect to working Internet connection", false);
						}
					}

				}
			});
			dialog.show();



			return true;  

		case R.id.coment:
			if(isLogin())
			{
				objAllBean=arrayOfHome.get(position);
				Constant.CATEGORYLIST_IDD=objAllBean.getCLID();
				Constant.ACTORLIST_TITLEE=objAllBean.getCLTITLE();
				Log.e("vid", ""+Constant.CATEGORYLIST_IDD);
				Intent intentupload=new Intent(getApplicationContext(),CommentActivity.class);
				intentupload.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(intentupload);
			}
			else
			{
				//Toast.makeText(MovieDetailsActivity.this, "If you want add comment then you need to Login First.", Toast.LENGTH_SHORT).show();
				Intent up_auth=new Intent(getApplicationContext(),AuthonticationActivity.class);
				up_auth.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(up_auth);	
				Constant.LOGIN_FORM="Upload";
			}

			return true;


		default:
			return super.onOptionsItemSelected(menuItem);
		}
	}
	public boolean isLogin() {

		SessionManager sessionManager=new SessionManager(getApplicationContext());
		return sessionManager.isLoggedIn();
	}

	private	class MyTaskRating extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(MovieDetailsActivity.this);
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
				showToast("No data found from web!!!");

			} else {

				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.CATEGORY_ARRAY_NAME);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);
						rate_msg=objJson.getString(Constant.RATE_MSG);
					}

				} catch (JSONException e) {
					e.printStackTrace();
				}
				setAdapterToListviewRate();
			}

		}

		public void setAdapterToListviewRate() {

			showToast(rate_msg);

			if(rate_msg.equals("You have already rated"))
			{

			}
			else
			{

			}

		}
	}

	private	class MyTaskView extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(MovieDetailsActivity.this);
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
				showToast("No data found from web!!!");

			} else {

				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.CATEGORY_ARRAY_NAME);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);
						rate_msg=objJson.getString(Constant.RATE_MSG);
					}

				} catch (JSONException e) {
					e.printStackTrace();
				}
				setAdapterToListviewRate();
			}

		}

		public void setAdapterToListviewRate() {

			//showToast(rate_msg);

			if(rate_msg.equals("You Have Already Views"))
			{

			}
			else
			{


			}

		}
	}
}

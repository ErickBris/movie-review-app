package com.apps.moviereview;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.example.adapter.CommentList_Adapter;
import com.example.item.Item_CommentList;
import com.example.util.AlertDialogManager;
import com.example.util.Constant;
import com.example.util.JsonUtils;
import com.example.util.SessionManager;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.startapp.android.publish.StartAppAd;

public class CommentActivity extends ActionBarActivity {

	Toolbar toolbar;
	AlertDialogManager alert = new AlertDialogManager();
	ListView lsv_cmt;
	EditText edt_cmt;
	Button btn_submit;
	List<Item_CommentList> arrayOfmovieList;
	CommentList_Adapter objAdapter;
	JsonUtils util;
	SessionManager session;
	HashMap<String, String> user;
	String strEmail,strPassword,strMessage,strPassengerId;
	private AdView mAdView;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		StartAppAd.init(this, getString(R.string.startapp_dev_id), getString(R.string.startapp_app_id,false));
		setContentView(R.layout.commentlist_activity);
		toolbar = (android.support.v7.widget.Toolbar) this.findViewById(R.id.toolbar);
		toolbar.setTitle(Constant.ACTORLIST_TITLEE);
		this.setSupportActionBar(toolbar);
		getSupportActionBar().setDisplayHomeAsUpEnabled(true);
		getSupportActionBar().setDisplayShowHomeEnabled(true);

		StartAppAd.showSlider(this);
		mAdView = (AdView) findViewById(R.id.adView);
		mAdView.loadAd(new AdRequest.Builder().build());

		lsv_cmt=(ListView)findViewById(R.id.lsv_cmtlist);
		edt_cmt=(EditText)findViewById(R.id.edtcmt);
		btn_submit=(Button)findViewById(R.id.button_cmtsub);

		arrayOfmovieList=new ArrayList<Item_CommentList>();


		util=new JsonUtils(getApplicationContext());

		if (JsonUtils.isNetworkAvailable(CommentActivity.this)) {
			new MyTask().execute(Constant.COMMENTLIST_URL+Constant.CATEGORYLIST_IDD);
			//Log.e("url", ""+Constant.COMMENTLIST_URL+Constant.CATEGORYLIST_IDD);
		} else {
			showToast("No Network Connection!!!");
			alert.showAlertDialog(CommentActivity.this, "Internet Connection Error",
					"Please connect to working Internet connection", false);
		}

		session = new SessionManager(getApplicationContext());
		user = session.getUserDetails();
		strEmail=user.get(SessionManager.KEY_EMAIL);
		//strPassword=user.get(SessionManager.KEY_PASSENGER_ID);
		strPassengerId=user.get(SessionManager.KEY_PASSENGER_ID);

		btn_submit.setOnClickListener(new View.OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if(edt_cmt.getText().toString().length() == 0 )
				{
					edt_cmt.setError( "Comment is Required!" );
				}
				else
				{
					if (JsonUtils.isNetworkAvailable(CommentActivity.this)) {

						String edtcoment=edt_cmt.getText().toString().replace(" ", "%20");
						new MyTaskPost().execute(Constant.COMMENTSUB_URL+"&movie_id="+Constant.CATEGORYLIST_IDD+"&user_id="+strPassengerId+"&comment="+edtcoment);
						//Log.e("add", ""+Constant.COMMENTSUB_URL+"&movie_id="+Constant.CATEGORYLIST_IDD+"&user_id="+strPassengerId+"&comment="+edtcoment);
					} else {
						showToast("No Network Connection!!!");
						alert.showAlertDialog(CommentActivity.this, "Internet Connection Error",
								"Please connect to working Internet connection", false);
					}

					Intent intentsubmit=new Intent(CommentActivity.this,CommentActivity.class);
					intentsubmit.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
					startActivity(intentsubmit);
					Toast.makeText(getApplicationContext(), "Comment Added SuccessFull", Toast.LENGTH_SHORT).show();

				}
			}
		});


	}


	private	class MyTaskPost extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(CommentActivity.this);
			pDialog.setMessage(getString(R.string.loading));
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
				alert.showAlertDialog(CommentActivity.this, "Server Connection Error",
						"May Server Under Maintaines Or Low Network", false);

			} else {
				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.USER_LOGIN_ARRAY);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);
						if(objJson.has(Constant.COMMENT_MSG))
						{
							strMessage=objJson.getString(Constant.COMMENT_MSG);
							Constant.GET_SUCCESS_CMTMSG=objJson.getString(Constant.COMMENT_SUCCESS);		
						}
						else
						{
							Constant.GET_SUCCESS_CMTMSG=objJson.getString(Constant.COMMENT_SUCCESS);

						}


					}
				} catch (JSONException e) {
					e.printStackTrace();
				}
			}
		}
	}
	public void showToast(String msg) {
		Toast.makeText(CommentActivity.this, msg, Toast.LENGTH_LONG).show();
	}

	private	class MyTask extends AsyncTask<String, Void, String> {

		ProgressDialog pDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();

			pDialog = new ProgressDialog(CommentActivity.this);
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
				alert.showAlertDialog(CommentActivity.this, "Server Connection Error",
						"May Server Under Maintaines Or Low Network", false);

			} else {

				try {
					JSONObject mainJson = new JSONObject(result);
					JSONArray jsonArray = mainJson.getJSONArray(Constant.CATEGORY_ARRAY_NAME);
					JSONObject objJson = null;
					for (int i = 0; i < jsonArray.length(); i++) {
						objJson = jsonArray.getJSONObject(i);

						Item_CommentList objItem = new Item_CommentList();

						if(objJson.has(Constant.COMMENT_MSG))
						{

							Toast.makeText(getApplicationContext(), "No Comment Found", Toast.LENGTH_SHORT).show();		

						}
						else
						{
							objItem.setCommentUserName(objJson.getString(Constant.COMMENTLIST_USENAME));
							objItem.setCommentMsg(objJson.getString(Constant.COMMENTLIST_COMMENT));
							objItem.setCommentTime(objJson.getString(Constant.COMMENTLIST_TIME));
							arrayOfmovieList.add(objItem);
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
		objAdapter = new CommentList_Adapter(CommentActivity.this, R.layout.item_cmtlist,
				arrayOfmovieList);
		lsv_cmt.setAdapter(objAdapter);


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

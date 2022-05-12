package com.example.adapter;

import java.sql.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.List;

import android.app.Activity;
import android.content.Context;
import android.text.format.DateUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.example.imageloader.ImageLoader;
import com.example.item.Item_CommentList;
import com.apps.moviereview.R;

public class CommentList_Adapter extends ArrayAdapter<Item_CommentList>{

	private Activity activity;
	private List<Item_CommentList> itemsnewslist;
	private Item_CommentList objnewslistBean;
	private int row;
	public ImageLoader imageLoader; 


	public CommentList_Adapter(Activity act, int resource, List<Item_CommentList> arrayList) {
		super(act, resource, arrayList);
		this.activity = act;
		this.row = resource;
		this.itemsnewslist = arrayList;
		imageLoader=new ImageLoader(activity);


	}
	@Override
	public View getView(final int position, View convertView, ViewGroup parent) {
		View view = convertView;
		ViewHolder holder;
		if (view == null) {
			LayoutInflater inflater = (LayoutInflater) activity
					.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
			view = inflater.inflate(row, null);

			holder = new ViewHolder();
			view.setTag(holder);
		} else {
			holder = (ViewHolder) view.getTag();
		}

		if ((itemsnewslist == null) || ((position + 1) > itemsnewslist.size()))
			return view;

		objnewslistBean = itemsnewslist.get(position);

		holder.txt_user=(TextView)view.findViewById(R.id.txt_username);
		holder.txt_cmt=(TextView)view.findViewById(R.id.txt_comment);
		holder.txt_time=(TextView)view.findViewById(R.id.txt_time);
 
		holder.txt_user.setText(objnewslistBean.getCommentUserName().toString());
		holder.txt_cmt.setText(objnewslistBean.getCommentMsg().toString());
		 // Converting timestamp into x ago format
//        CharSequence timeAgo = DateUtils.getRelativeTimeSpanString(
//                Long.parseLong("1443180600"),
//                System.currentTimeMillis(), DateUtils.SECOND_IN_MILLIS);
//        holder.txt_time.setText(timeAgo);
		long timestamp = Long.parseLong(objnewslistBean.getCommentTime()) * 1000; 
	    holder.txt_time.setText(getDate(timestamp ));  

		return view;

	}
	private String getDate(long timeStamp){

	    try{
	        DateFormat sdf = new SimpleDateFormat("dd/MM/yyyy");
	        Date netDate = (new Date(timeStamp));
	        return sdf.format(netDate);
	    }
	    catch(Exception ex){
	        return "xx";
	    }
	} 
	public class ViewHolder {

		public  TextView txt_user,txt_cmt,txt_time;


	}


}

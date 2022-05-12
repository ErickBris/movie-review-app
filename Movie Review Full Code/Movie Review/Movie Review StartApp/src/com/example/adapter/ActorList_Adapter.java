package com.example.adapter;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
import com.example.imageloader.ImageLoader;
import com.example.item.Item_ActorList;
import com.apps.moviereview.R;
import com.example.util.Constant;
import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class ActorList_Adapter extends ArrayAdapter<Item_ActorList>{

	private Activity activity;
	private List<Item_ActorList> itemsnewslist;
	private Item_ActorList objnewslistBean;
	private int row;
	public ImageLoader imageLoader; 
	private ArrayList<Item_ActorList> arraylist;

	public ActorList_Adapter(Activity act, int resource, List<Item_ActorList> arrayList) {
		super(act, resource, arrayList);
		this.activity = act;
		this.row = resource;
		this.itemsnewslist = arrayList;
		imageLoader=new ImageLoader(activity);
		this.arraylist = new ArrayList<Item_ActorList>();
		this.arraylist.addAll(itemsnewslist);

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

		holder.txt_tilte=(TextView)view.findViewById(R.id.txt_catelist);
		holder.txt_viewcount=(TextView)view.findViewById(R.id.txt_viewcount);
		holder.img_movielist=(ImageView)view.findViewById(R.id.img_catlist);
		holder.img_rating=(ImageView)view.findViewById(R.id.image_rating);

		holder.txt_tilte.setText(objnewslistBean.getActorLTITLE().toString());
		holder.txt_viewcount.setText(objnewslistBean.getActorLMVIEW().toString());
		
		if(objnewslistBean.getActorLMRATE().equals("0"))
		{
			holder.img_rating.setImageResource(R.drawable.star_0);
		}
		if(objnewslistBean.getActorLMRATE().equals("1"))
		{
			holder.img_rating.setImageResource(R.drawable.star_1);
		}
		else if(objnewslistBean.getActorLMRATE().equals("2"))
		{
			holder.img_rating.setImageResource(R.drawable.star_2);
		}
		else if(objnewslistBean.getActorLMRATE().equals("3"))
		{
			holder.img_rating.setImageResource(R.drawable.star_3);
		}
		else if(objnewslistBean.getActorLMRATE().equals("4"))
		{
			holder.img_rating.setImageResource(R.drawable.star_4);
		}
		else if(objnewslistBean.getActorLMRATE().equals("5"))
		{
			holder.img_rating.setImageResource(R.drawable.star_5);
		}
		imageLoader.DisplayImage(Constant.SERVER_IMAGE_THUMB+objnewslistBean.getActorLMIMG().toString(), holder.img_movielist);

		return view;

	}

	public class ViewHolder {

		public ImageView img_movielist,img_rating;
		public  TextView txt_tilte,txt_viewcount;


	}

	public void filter(String charText) {
		charText = charText.toLowerCase(Locale.getDefault());
		itemsnewslist.clear();
		if (charText.length() == 0) {
			itemsnewslist.addAll(arraylist);
		} 
		else 
		{
			for (Item_ActorList wp : arraylist) 
			{
				if (wp.getActorLTITLE().toLowerCase(Locale.getDefault()).contains(charText)) 
				{
					itemsnewslist.add(wp);
				}
			}
		}
		notifyDataSetChanged();
	}
}

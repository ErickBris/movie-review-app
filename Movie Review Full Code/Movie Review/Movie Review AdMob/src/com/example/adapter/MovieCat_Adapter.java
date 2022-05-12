package com.example.adapter;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.example.imageloader.ImageLoader;
import com.example.item.Item_MovieCat;
import com.apps.moviereview.R;

public class MovieCat_Adapter extends ArrayAdapter<Item_MovieCat> {

	private Context context;
	private List<Item_MovieCat> itemsCategory;
	private Item_MovieCat objCategoryBean;
	private int row;
	public ImageLoader imageLoader; 
	private ArrayList<Item_MovieCat> arraymoviecat;
	
 	public MovieCat_Adapter(Context context, int resource, List<Item_MovieCat> arrayList) {
		super(context, resource, arrayList);
		this.context = context;
		this.row = resource;
		this.itemsCategory = arrayList;
		this.arraymoviecat = new ArrayList<Item_MovieCat>();
		this.arraymoviecat.addAll(itemsCategory);
  	}
	@Override
	public View getView(final int position, View convertView, ViewGroup parent) {
		View view = convertView;
		ViewHolder holder;
		if (view == null) {
			LayoutInflater inflater = (LayoutInflater) context
					.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
			view = inflater.inflate(row, null);

			holder = new ViewHolder();
			view.setTag(holder);
		} else {
			holder = (ViewHolder) view.getTag();
		}

		if ((itemsCategory == null) || ((position + 1) > itemsCategory.size()))
			return view;

		objCategoryBean = itemsCategory.get(position);


		holder.txt_catname=(TextView)view.findViewById(R.id.txt_categty);
		holder.txt_catname.setText(objCategoryBean.getCategoryName().toString());

		return view;

	}

	public class ViewHolder {

		public TextView txt_catname;

	}

	public void filter(String charText) {
		charText = charText.toLowerCase(Locale.getDefault());
		itemsCategory.clear();
		if (charText.length() == 0) {
			itemsCategory.addAll(arraymoviecat);
		} 
		else 
		{
			for (Item_MovieCat wp : arraymoviecat) 
			{
				if (wp.getCategoryName().toLowerCase(Locale.getDefault()).contains(charText)) 
				{
					itemsCategory.add(wp);
				}
			}
		}
		notifyDataSetChanged();
	}
}

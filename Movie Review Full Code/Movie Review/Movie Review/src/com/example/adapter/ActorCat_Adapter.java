package com.example.adapter;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import com.example.imageloader.ImageLoader;
import com.example.item.Item_ActorCat;
import com.apps.moviereview.R;
import com.example.util.Constant;

public class ActorCat_Adapter extends ArrayAdapter<Item_ActorCat>{

	private Activity activity;
	private List<Item_ActorCat> itemsactorcat;
	private Item_ActorCat objBeanActorCat;
	private int row;
	public ImageLoader imageLoader; 
	private ArrayList<Item_ActorCat> arrayactorcat;

	public ActorCat_Adapter(Activity act, int resource, List<Item_ActorCat> arrayList) {
		super(act, resource, arrayList);
		this.activity = act;
		this.row = resource;
		this.itemsactorcat = arrayList;
		imageLoader=new ImageLoader(activity);
		this.arrayactorcat = new ArrayList<Item_ActorCat>();
		this.arrayactorcat.addAll(itemsactorcat);

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

		if ((itemsactorcat == null) || ((position + 1) > itemsactorcat.size()))
			return view;

		objBeanActorCat= itemsactorcat.get(position);

		holder.txt_actorcate=(TextView)view.findViewById(R.id.txt_actorcate);
		holder.img_actorcate=(ImageView)view.findViewById(R.id.img_actorcate);

		holder.txt_actorcate.setText(objBeanActorCat.getActorCatName().toString());

		imageLoader.DisplayImage(Constant.SERVER_IMAGE_UPFOLDER_THUMB+objBeanActorCat.getActorCatImage().toString().replace(" ", "%20"), holder.img_actorcate);

		return view;

	}

	public class ViewHolder {

		public ImageView img_actorcate;
		public  TextView txt_actorcate;

	}

	public void filter(String charText) {
		charText = charText.toLowerCase(Locale.getDefault());
		itemsactorcat.clear();
		if (charText.length() == 0) {
			itemsactorcat.addAll(arrayactorcat);
		} 
		else 
		{
			for (Item_ActorCat wp : arrayactorcat) 
			{
				if (wp.getActorCatName().toLowerCase(Locale.getDefault()).contains(charText)) 
				{
					itemsactorcat.add(wp);
				}
			}
		}
		notifyDataSetChanged();
	}
}

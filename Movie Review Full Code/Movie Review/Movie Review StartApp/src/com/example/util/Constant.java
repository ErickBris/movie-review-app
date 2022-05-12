package com.example.util;

import java.io.Serializable;

public class Constant implements Serializable{

	/**
	 * 
	 */
	private static final long serialVersionUID = 1L; 

	//images url
	public static final String SERVER_IMAGE_UPFOLDER_THUMB="http://www.viaviweb.in/Apps/movie_review_app/upload/";
	
	//thumb image path
	public static final String SERVER_IMAGE_THUMB="http://www.viaviweb.in/Apps/movie_review_app/upload/thumbs/";
	
	//moviecat url
	public static final String MOVIECAT_URL="http://www.viaviweb.in/Apps/movie_review_app/api.php";

	//movielist url
	public static final String MOVIELIST_URL="http://www.viaviweb.in/Apps/movie_review_app/api.php?cid=";

	//singlemoview url
	public static final String SINGLEMOVIE_URL="http://www.viaviweb.in/Apps/movie_review_app/api.php?movie_id=";

	//rating url
	public static final String RATING_URL="http://www.viaviweb.in/Apps/movie_review_app/api_rating.php?movie&device_id=";

	//viewcount url
	public static final String VIEWCOUNT_URL="http://www.viaviweb.in/Apps/movie_review_app/api_view.php?view&device_id=";

	//register
	public static final String REGISTER_URL = " http://www.viaviweb.in/Apps/movie_review_app/api.php?task=registration";

	//login
	public static final String LOGIN_URL = "http://www.viaviweb.in/Apps/movie_review_app/api.php?task=login";

	//comment submit
	public static final String COMMENTSUB_URL = "http://www.viaviweb.in/Apps/movie_review_app/api.php?comments";

	//commentlist submit
	public static final String COMMENTLIST_URL = "http://www.viaviweb.in/Apps/movie_review_app/api.php?mid=";

	//actorcat url
	public static final String ACTORCAT_URL="http://www.viaviweb.in/Apps/movie_review_app/api.php?actors";

	//actorlist url
	public static final String ACTORLIST_URL="http://www.viaviweb.in/Apps/movie_review_app/api.php?actors_id=";

	//genresrcat url
	public static final String GENRESCAT_URL="http://www.viaviweb.in/Apps/movie_review_app/api.php?genres";

	//genresrlist url
	public static final String GENRESLIST_URL="http://www.viaviweb.in/Apps/movie_review_app/api.php?genres_id=";
 
	public static final String CATEGORY_ARRAY_NAME="MovieReview";
	public static final String CATEGORY_CID="cid";
	public static final String CATEGORY_NAME="category_name";

	public static final String CATEGORYLIST_ID="id";
	public static final String CATEGORYLIST_CID="cid";
	public static final String CATEGORYLIST_GID="genre_id";
	public static final String CATEGORYLIST_TITLE="movie_title";
	public static final String CATEGORYLIST_MCAST="movie_casts";
	public static final String CATEGORYLIST_MIMG="movie_image";
	public static final String CATEGORYLIST_MDESC="movie_desc";
	public static final String CATEGORYLIST_MDATE="movie_date";
	public static final String CATEGORYLIST_MVIEW="movie_view";
	public static final String CATEGORYLIST_MRATE="movie_rate_avg";

	public static final String RELATED_ITEM_ARRAY_NAME="related";
	public static final String RELATED_ITEM_MID="rel_id";
	public static final String RELATED_ITEM_MNAME="rel_movie_title";
	public static final String RELATED_ITEM_MTHUMB="rel_movie_thumbnail";

	public static final String ACTORCAT_ID="id";
	public static final String ACTORCAT_NAME="actors_name";
	public static final String ACTORCAT_IMAGE="actors_image";

	public static final String ACTORLIST_ID="movie_id";
	public static final String ACTORLIST_CID="cid";
	public static final String ACTORLIST_GID="genre_id";
	public static final String ACTORLIST_TITLE="movie_title";
	public static final String ACTORLIST_MCAST="movie_casts";
	public static final String ACTORLIST_MIMG="movie_image";
	public static final String ACTORLIST_MDESC="movie_desc";
	public static final String ACTORLIST_MDATE="movie_date";
	public static final String ACTORLIST_MVIEW="movie_view";
	public static final String ACTORLIST_MRATE="movie_rate_avg";

	public static final String COMMENTLIST_USENAME="username";
	public static final String COMMENTLIST_COMMENT="comment";
	public static final String COMMENTLIST_TIME="created";

	public static final String GENRESCAT_ID="id";
	public static final String GENRESCAT_NAME="genres_name";

	//for title display in CategoryItemF
	public static String CATEGORY_IDD;
	public static String CATEGORY_NAMEE;
	public static String CATEGORYLIST_IDD;
	public static  String ACTORCAT_IDD;
	public static  String ACTORCAT_NAMEE;
	public static  String GENRESCAT_IDD;
	public static  String GENRESCAT_NAMEE;
	public static  String ACTORLIST_TITLEE;
 
	//rate
	public static final String RATE_MSG="MSG";
	public static String DEVICE_ID,LOGIN_FORM;

	//Register
	public static final String USER_REG_ARRAY="MovieReview";
	public static final String USER_REG_MSG="msg";
	public static final String USER_REG_SUCESS="Success";

	// Login
	public static final String USER_LOGIN_ARRAY="MovieReview";
	public static final String USER_LOGIN_MSG="msg";
	public static final String USER_LOGIN_SUCESS="Success";
	public static final String USER_LOGIN_ID="id";
	public static final String USER_LOGIN_NAME="username";
	public static final String USER_LOGIN_MAIL="email";
	public static int GET_SUCCESS_MSG;

	//comment
	public static final String COMMENT_SUCCESS="Success";
	public static final String COMMENT_MSG="msg";
	public static String GET_SUCCESS_CMTMSG;


}

var config = require("../../config.production.json");

module.exports = {
    get_results_mysql: function(table,where,select = '*',con,callback)
	{
		var query = "Select "+select+" from "+table+" where "+where;
//        console.log(query);
		con.query(query, function (err, results) {
			callback(results);
		});
	},
	delete_record_mysql: function(query,con)
	{
		con.query(query, function (err, results) {});
	},
	insert_record_mysql: function(query,con)
	{
//        console.log(query);
		con.query(query, function (err, results) {});
	},
	insert_record_mysql_callable: function(query,con,callback = [])
	{
		con.query(query, function (err, results) { if(callback.length > 0) {callback(results.insertId);} });
	},
	update_record_mysql: function(query,con)
	{
//        console.log(query);
		con.query(query, function (err, results) {});
	},
	distance: function(lat1, lon1, lat2, lon2, unit) 
	{
		var radlat1 = Math.PI * lat1/180
		var radlat2 = Math.PI * lat2/180
		var theta = lon1-lon2
		var radtheta = Math.PI * theta/180
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		dist = Math.acos(dist)
		dist = dist * 180/Math.PI
		dist = dist * 60 * 1.1515
		if (unit=="K") { dist = dist * 1.609344 }
		if (unit=="N") { dist = dist * 0.8684 }
		return dist
	},
	validate_params: function(params)
	{
		if(params !== undefined && params !== null && params !== '')
		{
			return params;
		}
		else
		{
			return false;
		}
	},
	validate_results: function(results)
	{
		if(results !== undefined && results !== null && results.length > 0 )
		{
			return results;
		}
		else
		{
			return false;
		}
	}
};
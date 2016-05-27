using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Routing;

namespace Einsatzplanungstool.WebApp.Extensions
{
	public static class RequestExtensions
	{
		public static bool IsCurrentRoute(this RequestContext context, string areaName, string controllerName, params string[] actionNames)
		{
			var routeData = context.RouteData;
			var routeArea = routeData.DataTokens["area"] as string;
			var current = false;

			if (((string.IsNullOrEmpty(routeArea) && string.IsNullOrEmpty(areaName)) || (routeArea == areaName)) 
				&& ((string.IsNullOrEmpty(controllerName)) || (routeData.GetRequiredString("controller") == controllerName)) 
				&& ((actionNames == null) || actionNames.Contains(routeData.GetRequiredString("action"))))
			{
				current = true;
			}

			return current;
		}
	}
}
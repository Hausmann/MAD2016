﻿using Einsatzplanung.API.Models;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class FachausbilderController : ApiController
    {
       [HttpPost]
       [Route("api/fachausbilder")]
       public HttpResponseMessage PostFachausbilder([FromBody] Fachausbilder fachausbilder)
        {
            return Request.CreateResponse(HttpStatusCode.OK);
        }

        
    }
}
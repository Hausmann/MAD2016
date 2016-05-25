using Einsatzplanung.API.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class AusbilderController : ApiController
    {
        [HttpGet]
        [Route("api/ausbilder/{persNummer}")]
        public int GetAusbilderID([FromUri] int persNummer)
        {

            return 0;
        }
    
        [HttpPost]
        [Route("api/ausbilder")]
        public HttpResponseMessage CreateAusbilder([FromBody] Ausbilder ausbilder)
        {

            return Request.CreateResponse(HttpStatusCode.OK);
        }
    }
}
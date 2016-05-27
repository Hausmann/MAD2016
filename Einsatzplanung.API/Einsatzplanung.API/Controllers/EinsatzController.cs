using Einsatzplanung.API.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class EinsatzController : ApiController
    {
      [HttpPost]
      [Route("api/einsatz")]
      public HttpResponseMessage PostEinsatz([FromBody] Einsaetze einsatz)
      {
                foreach (var einsatz in context.Einsatz)
            {
                    if(einsatz.AbteilungID == abteilungID)
                {
                    context.Einsatz.Add(einsatz);
                    context.SaveChangesAsync();
                    
                }
                return Request.CreateResponse(HttpStatusCode.OK);
            }
            return Request.CreateResponse(HttpStatusCode.NotFound);
       }
    }
}

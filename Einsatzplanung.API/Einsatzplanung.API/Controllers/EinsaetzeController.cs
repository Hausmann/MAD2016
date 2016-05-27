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
    public class EinsaetzeController : ApiController
    {
      [HttpPost]
      [Route("api/einsatz")]
      public HttpResponseMessage PostEinsatz([FromBody] Einsaetze einsatz)
      {
            if (einsatz != null)
            {
                using (var context = new EinsatzplanungContext())
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
